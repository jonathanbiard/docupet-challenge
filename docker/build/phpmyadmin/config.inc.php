<?php
$cfg['blowfish_secret']                = 'a8b7c6d';
$cfg['LoginCookieValidity']            = 31557600;
$cfg['UploadDir']                      = '';
$cfg['SaveDir']                        = '';
$cfg['Servers'][1]['AllowNoPassword']  = false;
$cfg['Servers'][1]['auth_type']        = 'cookie';
//$cfg['Servers'][1]['user']             = '';
//$cfg['Servers'][1]['password']         = '';
$cfg['Servers'][1]['socket']           = '/var/run/mysqld/mysqld.sock';
$cfg['Servers'][1]['host']             = '127.0.0.1';
$cfg['Servers'][1]['connect_type']     = 'tcp';
$cfg['Servers'][1]['compress']         = false;
$cfg['Servers'][1]['extension']        = 'mysqli';
$cfg['Servers'][1]['controlhost']      = '127.0.0.1';
$cfg['Servers'][1]['controlport']      = '3306';
$cfg['Servers'][1]['controluser']      = 'pma';
$cfg['Servers'][1]['controlpass']      = 'pma';
$cfg['Servers'][1]['pmadb']            = 'phpmyadmin';
$cfg['Servers'][1]['bookmarktable']    = 'pma__bookmark';
$cfg['Servers'][1]['relation']         = 'pma__relation';
$cfg['Servers'][1]['table_info']       = 'pma__table_info';
$cfg['Servers'][1]['table_coords']     = 'pma__table_coords';
$cfg['Servers'][1]['pdf_pages']        = 'pma__pdf_pages';
$cfg['Servers'][1]['column_info']      = 'pma__column_info';
$cfg['Servers'][1]['history']          = 'pma__history';
$cfg['Servers'][1]['table_uiprefs']    = 'pma__table_uiprefs';
$cfg['Servers'][1]['tracking']         = 'pma__tracking';
$cfg['Servers'][1]['designer_coords']  = 'pma__designer_coords';
$cfg['Servers'][1]['userconfig']       = 'pma__userconfig';
$cfg['Servers'][1]['recent']           = 'pma__recent';
$cfg['Servers'][1]['users']            = 'pma__users';
$cfg['Servers'][1]['usergroups']       = 'pma__usergroups';
$cfg['Servers'][1]['navigationhiding'] = 'pma__navigationhiding';
