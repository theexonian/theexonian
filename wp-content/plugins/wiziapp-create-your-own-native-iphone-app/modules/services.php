<?php
	require_once(dirname(dirname(__FILE__)).'/includes/settings.php');
	require_once(dirname(dirname(__FILE__)).'/includes/hook.php');

        class WiziappPluginModuleServices
	{
            function init()
		{
			wiziapp_plugin_hook()->hookLoad(array(&$this, 'load'));
		}
                
                function load()
		{
                        if (!isset($_GET['wiziapp_plugin']) || $_GET['wiziapp_plugin'] !== 'get_configuration')
			{
				return;
			}
                        
                        wiziapp_plugin_hook()->json_output($this->getConfiguration());
                }
                
                function getConfiguration(){
                    $themeName = wiziapp_plugin_settings()->getWebappTheme();
                    
                    $themeOptions = $this->getOptions($themeName);
                    
                    return array('layouttype' => $this->getLayoutMenuType($themeName),
                                 'rooturl'=> trailingslashit(get_bloginfo('wpurl')),// get_bloginfo('wpurl'),
                                 'header'=>array(
                                    'title'=>$themeOptions['app_header_title'],
                                    'bgcolor'=>$themeOptions['app_header_background'],
                                    'image'=>$themeOptions['app_header_image']),
                                 'menu'=>$this->getMenu()
                                 )
                        ;
                }
                
                function getMenu(){
                    $menu_name = wiziapp_plugin_settings()->getWebappMenu();
                    
                    $selectedMenu = wp_get_nav_menu_object($menu_name);
                    
                    $items = array();
                    array_push($items, array('name'=>$menu_name));
                    foreach (wp_get_nav_menu_items($selectedMenu->name) As $menuItem){
                        array_push ($items,array('name'=>$menuItem->title,
                                         'icon'=>$menuItem->icon,
                                         'url'=>$menuItem->url));
                    }
                    return $items;
                }
                
                function getOptions($themeName){
                    $optionName = $this->getOptionName($themeName);
                    $options = get_option($optionName, array())+
				 array(
					 'app_header_title' => get_bloginfo('name'),
					 'app_header_image' => '',
					 'app_header_background' => '#111',
				 );
                    return $options;
                    
                }
                
                function getOptionName($themeName){
                    $optionNames = array(
                            'business_touch' => 'wiziapp_plugin_wiziapp_theme_business_touch_settings',
                            'magazine_touch' => 'wiziapp_plugin_wiziapp_magazine_touch_theme_settings',
                            'metro_touch' => 'wiziapp_plugin_wiziapp_theme_metro_touch_settings',
                            'itouch_theme' => 'wiziapp_plugin_wiziapp_itouch_theme_settings',
                            'advanced_theme' => 'wiziapp_plugin_wiziapp_advanced_theme_settings'
                    );
                    if (!isset($optionNames[$themeName]))
                    {
                        return 'wiziapp_theme_settings';
                    }
                    
                    return $optionNames[$themeName];
                }
                 
                function getLayoutMenuType($themeName){
                    
                    $layoutMenuTypes = array(
                        'business_touch' => 'sideMenu',
                        'magazine_touch' => 'sideMenu',
                        'metro_touch' => 'pushNavigation',
                        'itouch_theme' => 'slideMenu',
                        'advanced_theme' => 'slideMenu'
                        );
                     
                     if (!isset($layoutMenuTypes[$themeName])){
                         return 'slideMenu';
                     }       
                     
                     return $layoutMenuTypes[$themeName];
                }
                
                function Get_All_Wordpress_Menus(){
                    return get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
                }
        }

        $module = new WiziappPluginModuleServices();
	$module->init();
