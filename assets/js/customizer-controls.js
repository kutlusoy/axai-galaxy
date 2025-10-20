/**
 * Customizer Controls Scripts - AKTUALISIERT
 * @package AxAI_Galaxy
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Reset Settings Button
        $('.axai-reset-button').on('click', function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to reset ALL theme settings to their default values? This action cannot be undone and will delete all your customizations!')) {
                return;
            }
            
            var button = $(this);
            button.prop('disabled', true).val('Resetting...');
            
            $.ajax({
                url: axaiCustomizer.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'axai_reset_settings',
                    nonce: axaiCustomizer.resetNonce
                },
                success: function(response) {
                    if (response.success) {
                        alert('All settings have been reset to defaults. The page will now reload.');
                        window.location.reload();
                    } else {
                        alert('Error: ' + response.data);
                        button.prop('disabled', false).val('Reset to Defaults');
                    }
                },
                error: function() {
                    alert('An error occurred while resetting settings.');
                    button.prop('disabled', false).val('Reset to Defaults');
                }
            });
        });
        
        // Dynamic Logo Spacing CSS Variable
        wp.customize('axai_logo_spacing', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--logo-spacing', newval + 'px');
                }
            });
        });
        
        // Dynamic Header Boxed Width
        wp.customize('axai_header_boxed_width', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--header-boxed-width', newval + 'px');
                }
            });
        });
        
        // Dynamic Content Boxed Width
        wp.customize('axai_content_boxed_width', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--content-boxed-width', newval + 'px');
                }
            });
        });
        
        // Dynamic Footer Boxed Width
        wp.customize('axai_footer_boxed_width', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--footer-boxed-width', newval + 'px');
                }
            });
        });
        
        // Dynamic Header Transparency
        wp.customize('axai_header_transparency', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--header-transparency', newval / 100);
                }
            });
        });
        
        // Dynamic Footer Transparency
        wp.customize('axai_footer_transparency', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--footer-transparency', newval / 100);
                }
            });
        });
        
        // Dynamic Content Transparency
        wp.customize('axai_content_transparency', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--content-transparency', newval);
                }
                $('article').css('opacity', newval / 100);
            });
        });
        
        // Dynamic Content Background Color
        wp.customize('axai_content_bg_color', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--content-bg-color', newval);
                }
                $('article').css('background-color', newval);
            });
        });
        
        // Dynamic Link Color
        wp.customize('axai_link_color', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--link-color', newval);
                }
            });
        });
        
        // Dynamic Link Hover Color
        wp.customize('axai_link_hover_color', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--link-hover-color', newval);
                }
            });
        });
        
        // Dynamic Menu Text Color
        wp.customize('axai_menu_text_color', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--menu-text-color', newval);
                }
            });
        });
        
        // Dynamic Menu Text Size
        wp.customize('axai_menu_text_size', function(value) {
            value.bind(function(newval) {
                if (typeof document.documentElement.style.setProperty === 'function') {
                    document.documentElement.style.setProperty('--menu-text-size', newval + 'px');
                }
            });
        });
        
    });
    
})(jQuery);