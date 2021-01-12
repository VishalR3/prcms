<?php

function define_urls()
{
  define('SITE_ROOT',     base_url());
  define('UPLOADS',       SITE_ROOT .  'uploads/');
  define('SITE_ROOT_ADMIN',   SITE_ROOT . 'admin/');
  define('ASSETS_URL',     SITE_ROOT . 'assets/');
  define('ASSETS_URL_ADMIN',  SITE_ROOT . 'assets/admin/');
}
