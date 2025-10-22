/**
 * AxAI Galaxy Theme Scripts
 * @package AxAI_Galaxy
 * @since 1.0
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        var logoSpacing = $('body').data('logo-spacing') || 40;
        if (typeof document.documentElement.style.setProperty === 'function') {
            document.documentElement.style.setProperty('--logo-spacing', logoSpacing + 'px');
        }
        
        const menuToggle = $('#menuToggle');
        const mainMenu = $('.main-menu');
        
        menuToggle.on('click', function() {
            $(this).toggleClass('active');
            mainMenu.toggleClass('active');
            $('body').toggleClass('menu-open');
        });
        
        $(document).on('click', function(e) {
            if (!menuToggle.is(e.target) && menuToggle.has(e.target).length === 0 &&
                !mainMenu.is(e.target) && mainMenu.has(e.target).length === 0) {
                menuToggle.removeClass('active');
                mainMenu.removeClass('active');
                $('body').removeClass('menu-open');
            }
        });
        
        $('.main-menu a:not(.external)').on('click', function() {
            menuToggle.removeClass('active');
            mainMenu.removeClass('active');
            $('body').removeClass('menu-open');
        });
        
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        });
        
        const header = $('#masthead');
        let lastScroll = 0;
        
        $(window).on('scroll', function() {
            const currentScroll = $(this).scrollTop();
            
            if (currentScroll > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
            
            updateActiveMenuItem();
            
            lastScroll = currentScroll;
        });
        
        function updateActiveMenuItem() {
            const scrollPosition = $(window).scrollTop() + 100;
            const sections = $('.section');
            const menuItems = $('.main-menu a:not(.external)');
            
            sections.each(function() {
                const sectionTop = $(this).offset().top;
                const sectionHeight = $(this).outerHeight();
                const sectionId = $(this).attr('id');
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    menuItems.removeClass('active').parent().removeClass('current-menu-item');
                    menuItems.filter('[href="#' + sectionId + '"]')
                        .addClass('active')
                        .parent()
                        .addClass('current-menu-item');
                }
            });
        }
        
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.src;
            });
        } else {
            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
            document.body.appendChild(script);
        }
        
        $('.comment-reply-link').on('click', function(e) {
            e.preventDefault();
            const commentId = $(this).attr('data-commentid');
            const respondElement = $('#respond');
            const commentElement = $('#comment-' + commentId);
            
            if (commentElement.length) {
                commentElement.after(respondElement);
                $('#comment_parent').val(commentId);
                respondElement.find('#cancel-comment-reply-link').show();
            }
        });
        
        $('#cancel-comment-reply-link').on('click', function(e) {
            e.preventDefault();
            const respondElement = $('#respond');
            const commentFormElement = $('#commentform').parent();
            
            commentFormElement.append(respondElement);
            $('#comment_parent').val('0');
            $(this).hide();
        });
        
        $('.skip-link').on('click', function(e) {
            const target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                target.attr('tabindex', '-1');
                target.focus();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 500);
            }
        });
        
        function equalizeHeights() {
            if ($(window).width() > 768) {
                $('.blog-grid article').each(function() {
                    const $article = $(this);
                    const $entryContent = $article.find('.entry-content');
                    $entryContent.css('min-height', 'auto');
                });
                
                let maxHeight = 0;
                $('.blog-grid article .entry-content').each(function() {
                    const height = $(this).outerHeight();
                    if (height > maxHeight) {
                        maxHeight = height;
                    }
                });
                
                $('.blog-grid article .entry-content').css('min-height', maxHeight + 'px');
            } else {
                $('.blog-grid article .entry-content').css('min-height', 'auto');
            }
        }
        
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
        
        equalizeHeights();
        $(window).on('resize', debounce(equalizeHeights, 250));
        
        $(window).trigger('scroll');
        
    });
    
    $(window).on('load', function() {
        $('.image-loading').removeClass('image-loading');
    });
    
})(jQuery);
