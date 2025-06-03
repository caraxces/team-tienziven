<?php

defined('BASEPATH') or exit('No direct script access allowed');

class App_Session extends CI_Session
{
    /**
     * Class constructor
     *
     * @param   array   $params Configuration parameters
     * @return  void
     */
    public function __construct(array $params = [])
    {
        // No need to call parent constructor
        
        // Lấy các cài đặt cấu hình
        $this->_driver = config_item('sess_driver');
        
        // Chỉ khởi tạo session nếu driver là files
        if ($this->_driver !== 'database') {
            log_message('debug', "Session: Sử dụng driver '{$this->_driver}'");
            
            // Tải driver phù hợp
            $driver = 'Session_' . $this->_driver . '_driver';
            
            // Khởi tạo session driver
            $driver_path = APPPATH . 'libraries/Session/drivers/' . $driver . '.php';
            
            if (file_exists($driver_path)) {
                require_once $driver_path;
                $this->_driver = new $driver($params);
                
                if ($this->_driver instanceof SessionHandlerInterface) {
                    if (is_php('5.4')) {
                        session_set_save_handler($this->_driver, true);
                    } else {
                        session_set_save_handler(
                            [$this->_driver, 'open'],
                            [$this->_driver, 'close'],
                            [$this->_driver, 'read'],
                            [$this->_driver, 'write'],
                            [$this->_driver, 'destroy'],
                            [$this->_driver, 'gc']
                        );
                        
                        register_shutdown_function('session_write_close');
                    }
                    
                    // Khởi tạo session
                    session_start();
                } else {
                    log_message('error', "Session: Driver '{$this->_driver}' không thực hiện SessionHandlerInterface");
                }
            } else {
                log_message('error', "Session: Không tìm thấy driver '{$driver}'");
            }
        } else {
            log_message('debug', "Session: Chuyển sang sử dụng files driver thay vì database");
            
            // Cấu hình session sử dụng file driver
            ini_set('session.save_handler', 'files');
            session_save_path(APPPATH . 'cache/sessions');
            
            // Khởi tạo session với file driver
            session_start();
        }

        // Is session ID auto-regeneration configured? (ignoring ajax requests)
        if ((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
            && ($regenerate_time = config_item('sess_time_to_update')) > 0
        ) {
            if (! isset($_SESSION['__ci_last_regenerate'])) {
                $_SESSION['__ci_last_regenerate'] = time();
            } elseif ($_SESSION['__ci_last_regenerate'] < (time() - $regenerate_time)) {
                $this->sess_regenerate((bool) config_item('sess_regenerate_destroy'));
            }
        }
        // Another work-around ... PHP doesn't seem to send the session cookie
        // unless it is being currently created or regenerated
        elseif (isset($_COOKIE[$this->_config['cookie_name']]) && $_COOKIE[$this->_config['cookie_name']] === session_id()) {
            if (PHP_VERSION_ID < 70300) {
                $sameSite = '';

                if ($this->_config['sess_cookie_samesite'] !== '') {
                    $sameSite = '; samesite=' . $this->_config['sess_cookie_samesite'];
                }

                setcookie(
                    $this->_config['cookie_name'],
                    session_id(),
                    (empty($this->_config['cookie_lifetime']) ? 0 : time() + $this->_config['cookie_lifetime']),
                    $this->_config['cookie_path'] . $sameSite, // Hacky way to set SameSite for PHP 7.2 and earlier
                    $this->_config['cookie_domain'],
                    $this->_config['cookie_secure'],
                    true
                );
            } else {
                // PHP 7.3 adds another function signature allowing setting of samesite
                $params = [
                    'expires'  => (empty($this->_config['cookie_lifetime']) ? 0 : time() + $this->_config['cookie_lifetime']),
                    'path'     => $this->_config['cookie_path'],
                    'domain'   => $this->_config['cookie_domain'],
                    'secure'   => $this->_config['cookie_secure'],
                    'httponly' => true,
                ];

                if ($this->_config['sess_cookie_samesite'] !== '') {
                    $params['samesite'] = $this->_config['sess_cookie_samesite'];
                }

                setcookie(
                    $this->_config['cookie_name'],
                    session_id(),
                    $params
                );
            }
        }

        $this->_ci_init_vars();

        log_message('info', "Session: Class initialized using '" . $this->_driver . "' driver.");
    }

    /**
     * Configuration
     *
     * Handle input parameters and configuration defaults
     *
     * @param   array   &$params    Input parameters
     * @return  void
     */
    protected function _configure(&$params)
    {
        $expiration = config_item('sess_expiration');
        if (isset($params['cookie_lifetime'])) {
            $params['cookie_lifetime'] = (int) $params['cookie_lifetime'];
        } else {
            $params['cookie_lifetime'] = (! isset($expiration) && config_item('sess_expire_on_close'))
                ? 0 : (int) $expiration;
        }

        isset($params['cookie_name']) or $params['cookie_name'] = config_item('sess_cookie_name');
        if (empty($params['cookie_name'])) {
            $params['cookie_name'] = ini_get('session.name');
        } else {
            ini_set('session.name', $params['cookie_name']);
        }

        isset($params['cookie_path']) or $params['cookie_path']     = config_item('cookie_path');
        isset($params['cookie_domain']) or $params['cookie_domain'] = config_item('cookie_domain');
        isset($params['cookie_secure']) or $params['cookie_secure'] = (bool) config_item('cookie_secure');

        if (PHP_VERSION_ID < 70300) {
            $sameSite = '';
            if (config_item('sess_cookie_samesite') !== '') {
                $sameSite = '; samesite=' . config_item('sess_cookie_samesite');
            }

            session_set_cookie_params(
                $params['cookie_lifetime'],
                $params['cookie_path'] . $sameSite, // Hacky way to set SameSite for PHP 7.2 and earlier
                $params['cookie_domain'],
                $params['cookie_secure'],
                true // HTTP only; Yes, this is intentional and not configurable for security reasons.
            );
        } else {
            // PHP 7.3 adds support for setting samesite in session_set_cookie_params()
            $cookieParams = [
                'lifetime' => $params['cookie_lifetime'],
                'path'     => $params['cookie_path'],
                'domain'   => $params['cookie_domain'],
                'secure'   => $params['cookie_secure'],
                'httponly' => true, // HTTP only; Yes, this is intentional and not configurable for security reasons.
            ];

            if (config_item('sess_cookie_samesite') !== '') {
                $cookieParams['samesite'] = config_item('sess_cookie_samesite');
                ini_set('session.cookie_samesite', config_item('sess_cookie_samesite'));
            }

            session_set_cookie_params($cookieParams);
        }

        if (empty($expiration)) {
            $params['expiration'] = (int) ini_get('session.gc_maxlifetime');
        } else {
            $params['expiration'] = (int) $expiration;
            ini_set('session.gc_maxlifetime', $expiration);
        }

        $params['match_ip']                                 = (bool) (isset($params['match_ip']) ? $params['match_ip'] : config_item('sess_match_ip'));
        isset($params['save_path']) or $params['save_path'] = config_item('sess_save_path');

        $this->_config = $params;

        // Security is king
        ini_set('session.use_trans_sid', 0);
        ini_set('session.use_strict_mode', 1);
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);

        $this->_configure_sid_length();
    }

    /**
     * Handle temporary variables
     *
     * Clears old "flash" data, marks the new one for deletion and handles
     * "temp" data deletion.
     *
     * @return  void
     */
    protected function _ci_init_vars()
    {
        if (! empty($_SESSION['__ci_vars'])) {
            $current_time = time();

            foreach ($_SESSION['__ci_vars'] as $key => &$value) {
                if ($value === 'new') {
                    $_SESSION['__ci_vars'][$key] = 'old';
                }
                // Hacky, but 'old' will (implicitly) always be less than time() ;)
                // DO NOT move this above the 'new' check!
                elseif ($value === 'old') {
                    unset($_SESSION[$key], $_SESSION['__ci_vars'][$key]);
                }
            }

            if (empty($_SESSION['__ci_vars'])) {
                unset($_SESSION['__ci_vars']);
            }
        }

        $this->userdata = & $_SESSION;
    }
}
