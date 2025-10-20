# AxAI Galaxy Theme - Installation Guide

This guide will walk you through the complete installation and setup process for the AxAI Galaxy WordPress theme.

## Table of Contents

1. [Pre-Installation Requirements](#pre-installation-requirements)
2. [Installation Methods](#installation-methods)
3. [Initial Setup](#initial-setup)
4. [Customization](#customization)
5. [Troubleshooting](#troubleshooting)

## Pre-Installation Requirements

### System Requirements

- **WordPress**: Version 5.8 or higher
- **PHP**: Version 7.4 or higher
- **MySQL**: Version 5.6 or higher (or MariaDB 10.1+)
- **HTTPS**: Recommended for security
- **Memory Limit**: Minimum 64MB (128MB+ recommended)

### Browser Requirements

For optimal experience:
- Google Chrome 90+
- Mozilla Firefox 88+
- Safari 14+
- Microsoft Edge 90+

### Recommended Plugins

While not required, these plugins enhance the theme:
- **Elementor** - Page builder (free)
- **Contact Form 7** - Contact forms
- **Yoast SEO** - SEO optimization
- **WP Rocket** - Caching (optional)

## Installation Methods

### Method 1: WordPress Admin (Recommended)

1. **Download the Theme**
   - Download `axai-galaxy.zip` from your source
   - Keep the file zipped

2. **Upload via WordPress**
   - Log in to your WordPress admin panel
   - Navigate to **Appearance > Themes**
   - Click **Add New** at the top
   - Click **Upload Theme**
   - Choose the `axai-galaxy.zip` file
   - Click **Install Now**

3. **Activate the Theme**
   - After installation completes, click **Activate**
   - The theme is now active!

### Method 2: FTP Upload

1. **Unzip the Theme**
   - Extract `axai-galaxy.zip` on your computer
   - You should have a folder named `axai-galaxy`

2. **Upload via FTP**
   - Connect to your server using an FTP client (FileZilla, etc.)
   - Navigate to `/wp-content/themes/`
   - Upload the entire `axai-galaxy` folder
   - Wait for the upload to complete

3. **Activate via WordPress**
   - Log in to WordPress admin
   - Go to **Appearance > Themes**
   - Find "AxAI Galaxy" and click **Activate**

### Method 3: cPanel File Manager

1. **Access cPanel**
   - Log in to your hosting cPanel
   - Open **File Manager**

2. **Navigate to Themes**
   - Go to `public_html/wp-content/themes/`
   - Or `www/wp-content/themes/` depending on your setup

3. **Upload and Extract**
   - Click **Upload**
   - Upload `axai-galaxy.zip`
   - Right-click the uploaded file
   - Select **Extract**
   - Delete the .zip file after extraction

4. **Activate**
   - Go to WordPress Admin > Appearance > Themes
   - Activate AxAI Galaxy

## Initial Setup

### Step 1: Homepage Setup

1. **Create a Homepage**
   ```
   Pages > Add New
   - Title: "Home" (or your preference)
   - Publish the page
   ```

2. **Create a Blog Page** (if you want a separate blog)
   ```
   Pages > Add New
   - Title: "Blog"
   - Publish the page
   ```

3. **Set Static Front Page**
   ```
   Settings > Reading
   - Select "A static page"
   - Front page: Choose your "Home" page
   - Posts page: Choose your "Blog" page (optional)
   - Save Changes
   ```

### Step 2: Menu Setup

1. **Create Primary Menu**
   ```
   Appearance > Menus
   - Click "Create a new menu"
   - Name: "Primary Menu"
   - Check "Primary Menu" under Menu Locations
   - Add your pages to the menu
   - Save Menu
   ```

2. **Create Footer Menu** (optional)
   ```
   - Create another menu for footer
   - Check "Footer Menu" location
   - Add privacy policy, terms, etc.
   - Save Menu
   ```

### Step 3: Basic Customizer Settings

1. **Access Customizer**
   ```
   Appearance > Customize
   ```

2. **Set Site Identity**
   ```
   Site Identity
   - Upload your logo
   - Add site title and tagline
   - Upload site icon (favicon)
   ```

3. **Configure Galaxy** (This is unique to AxAI Galaxy!)
   ```
   Galaxy Parameters
   - Adjust speed settings
   - Configure star count
   - Set nebula opacity
   - Enable/disable galaxies
   - Choose your galaxy types
   - Adjust camera settings
   ```

4. **Layout Settings**
   ```
   Layout Settings > Header
   - Enable/disable sticky header
   - Set header layout (boxed/full-width)
   - Configure transparency
   
   Layout Settings > Content Width
   - Choose layout type
   - Set custom width if needed
   
   Layout Settings > Hero Section
   - Enable hero section
   - Set title and subtitle
   - Configure button text and URL
   
   Layout Settings > Blog
   - Choose column count (1-4)
   - Toggle featured images
   - Toggle excerpts
   
   Layout Settings > Footer
   - Set footer layout
   - Customize copyright text
   - Toggle theme credit
   ```

5. **Save Your Changes**
   - Click **Publish** at the top

### Step 4: Create Essential Pages

Create these important pages:

1. **About Page**
   ```
   Pages > Add New
   - Title: "About"
   - Add your content
   - Optionally add a featured image for header background
   - Publish
   ```

2. **Contact Page**
   ```
   Pages > Add New
   - Title: "Contact"
   - Add contact information
   - Consider adding Contact Form 7
   - Publish
   ```

3. **Privacy Policy**
   ```
   Settings > Privacy
   - Create or select privacy policy page
   ```

### Step 5: Widget Setup (Optional)

```
Appearance > Widgets

Sidebar:
- Add widgets for your sidebar content
- Drag and drop widgets as needed

Footer 1-4:
- Add footer widgets
- Each footer area appears as a column
- Common widgets: Text, Recent Posts, Categories
```

## Customization

### Galaxy Animation Customization

The galaxy animation is the star feature of this theme! Here's how to customize it:

#### Access Galaxy Parameters

```
Appearance > Customize > Galaxy Parameters
```

#### Speed Settings
- **Idle Speed**: How fast stars move normally (default: 0.5)
- **Warp Speed**: How fast during warp effect (default: 250)

**Tips:**
- Lower idle speed (0.1-0.3) for subtle movement
- Higher idle speed (1.0-3.0) for more dynamic feel
- Warp speed creates dramatic effect when hovering buttons

#### Star Settings
- **Star Count**: Total number of stars (500-3000)
  - 500-1000: Performance mode
  - 1000-1500: Balanced (recommended)
  - 1500-3000: Maximum visual impact

- **Radius**: Controls star distribution
  - Smaller radius: Stars closer to center
  - Larger radius: Stars spread wider

- **Depth Range**: 3D depth of starfield
  - Higher values: More depth perception
  - Lower values: Flatter appearance

- **Brightness**: Overall star brightness (1.0-5.0)
- **Opacity**: Base opacity of stars (0.1-1.0)

#### Nebula Settings
- **Count**: Number of nebula particles (20-200)
- **Size**: Base size of nebula clouds
- **Opacity**: Transparency of nebulae (0.1-0.8)

**Tip:** Reduce nebula count for better performance on slower devices

#### Galaxy Settings
- **Enable Galaxies**: Toggle spiral galaxies on/off
- **Maximum Galaxies**: How many can appear (1-10)
- **Size Range**: Min/max size of galaxies
- **Opacity**: Transparency of galaxies

**Galaxy Types:**
Each type has unique characteristics:
- **Milky Way Style**: 4 arms, bar structure
- **Andromeda Style**: 2 arms, tight spiral
- **Whirlpool Style**: Distinct spiral pattern
- **Pinwheel Style**: 5 arms, open structure
- **Triangulum Style**: 3 arms, irregular
- **Sombrero Style**: Edge-on appearance

#### Camera & Parallax
- **Field of View**: Camera perspective (60-120°)
  - Lower FOV: Zoomed in view
  - Higher FOV: Wide angle view

- **Parallax Intensity**: Mouse movement effect (0-30)
  - 0: No parallax
  - 10-15: Subtle movement (recommended)
  - 20-30: Strong parallax effect

- **Three.js URL**: Update library path for future versions

### Layout Customization

#### Content Width Options

**Boxed Layout:**
```
Default: 1200px max-width
- Content centered
- Comfortable reading width
- Professional appearance
```

**Full Width Layout:**
```
- Edge-to-edge content
- Modern, expansive feel
- Great for visual content
```

**Custom Width:**
```
- Specify exact pixel width
- Or use percentage (50-100%)
- Perfect for specific designs
```

#### Header Customization

**Sticky Header:**
- Stays visible while scrolling
- Improves navigation
- Recommended: ON

**Transparent Header:**
- Overlays hero section
- Creates immersive effect
- Works best with dark hero images

### Color Customization

Galaxy colors can be customized for:
- Nebula colors (Purple, Blue, Pink)
- Warp colors (Violet, Red)
- Star colors (Purple, Pink, Blue, White)

Each color uses RGB values (0.0 - 1.0):
```
Example: Purple = r: 0.5, g: 0.2, b: 0.8
```

## Advanced Configuration

### Elementor Integration

1. **Install Elementor**
   ```
   Plugins > Add New
   - Search "Elementor"
   - Install and Activate
   ```

2. **Edit Pages with Elementor**
   ```
   - Edit any page
   - Click "Edit with Elementor"
   - Drag and drop widgets
   - Design visually
   ```

3. **Theme Locations**
   - Header can be built with Elementor
   - Footer can be built with Elementor
   - Access via Elementor > Theme Builder

### Performance Optimization

#### Recommended Settings for Performance

**For Slower Devices:**
```
Star Count: 500-800
Nebula Count: 30-50
Galaxies: Disabled or max 2
Parallax: 5-10
```

**Balanced (Recommended):**
```
Star Count: 1000-1500
Nebula Count: 60-80
Galaxies: Enabled, max 3-5
Parallax: 10-15
```

**Maximum Visual Impact:**
```
Star Count: 2000-3000
Nebula Count: 100-150
Galaxies: Enabled, max 8-10
Parallax: 15-20
```

#### Caching

Install a caching plugin:
1. WP Rocket (Premium, recommended)
2. W3 Total Cache (Free)
3. WP Super Cache (Free)

**Note:** Exclude the galaxy animation from JavaScript minification/combination for best results.

### Child Theme (For Developers)

To customize code without losing changes:

1. **Create child theme folder:**
   ```
   /wp-content/themes/axai-galaxy-child/
   ```

2. **Create style.css:**
   ```css
   /*
   Theme Name: AxAI Galaxy Child
   Template: axai-galaxy
   */
   ```

3. **Create functions.php:**
   ```php
   <?php
   add_action('wp_enqueue_scripts', 'axai_child_enqueue_styles');
   function axai_child_enqueue_styles() {
       wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   }
   ```

4. **Activate child theme**

## Troubleshooting

### Common Issues and Solutions

#### Galaxy Animation Not Showing

**Problem:** Black background, no stars
**Solutions:**
1. Check browser console for JavaScript errors (F12)
2. Verify Three.js URL in Customizer is loading
3. Clear browser cache (Ctrl+F5)
4. Try a different browser
5. Check if JavaScript is enabled

#### Performance Issues

**Problem:** Slow animation, lag, or stuttering
**Solutions:**
1. Reduce star count in Galaxy Parameters
2. Decrease nebula particles
3. Disable galaxies temporarily
4. Lower parallax intensity
5. Update graphics drivers
6. Close other browser tabs
7. Check CPU/GPU usage

#### Header Not Sticky

**Problem:** Header scrolls away
**Solutions:**
1. Check "Sticky Header" in Customizer
2. Clear all caches
3. Check for CSS conflicts
4. Disable other plugins temporarily

#### Content Too Wide/Narrow

**Problem:** Layout issues
**Solutions:**
1. Check Content Width settings
2. Verify layout type (Boxed/Full-Width/Custom)
3. Clear browser cache
4. Check responsive breakpoints
5. Test without other plugins

#### Menu Not Appearing

**Problem:** Navigation menu missing
**Solutions:**
1. Assign menu to "Primary Menu" location
2. Check that menu has items
3. Clear cache
4. Check header layout settings

#### Images Not Loading

**Problem:** Broken images or slow loading
**Solutions:**
1. Regenerate thumbnails (plugin available)
2. Check image file permissions
3. Verify image paths
4. Test with default WordPress theme
5. Check .htaccess file

### Getting Help

If you're still experiencing issues:

1. **Check Documentation**
   - Review README.md
   - Read this INSTALL.md guide

2. **WordPress Forum**
   - Search WordPress support forums
   - Check for similar issues

3. **Contact Support**
   - Visit https://axai.at
   - Include:
     - WordPress version
     - PHP version
     - Active plugins list
     - Browser and version
     - Screenshots of issue
     - Console errors (if any)

## Best Practices

### Content Creation

1. **Use Quality Images**
   - Minimum 1200px wide
   - Optimize file size (use WebP if possible)
   - Add alt text for accessibility

2. **Write Compelling Content**
   - Break text into paragraphs
   - Use headings (H2, H3)
   - Add images between sections

3. **SEO Optimization**
   - Install Yoast SEO
   - Write meta descriptions
   - Use focus keywords
   - Create XML sitemap

### Security

1. **Keep Updated**
   - Update WordPress regularly
   - Update theme when available
   - Update all plugins

2. **Use Security Plugins**
   - Wordfence Security
   - iThemes Security
   - Limit login attempts

3. **Regular Backups**
   - UpdraftPlus
   - BackupBuddy
   - VaultPress

### Maintenance

**Weekly:**
- Check for updates
- Review comments
- Test contact forms

**Monthly:**
- Full site backup
- Check broken links
- Review analytics
- Test on mobile devices

**Quarterly:**
- Security audit
- Performance review
- Content audit
- Update plugins/theme

## Next Steps

After installation:

1. ✅ Create essential pages
2. ✅ Set up navigation menus
3. ✅ Customize galaxy animation
4. ✅ Add your content
5. ✅ Install recommended plugins
6. ✅ Configure SEO
7. ✅ Set up analytics
8. ✅ Test on multiple devices
9. ✅ Optimize images
10. ✅ Launch your site!

## Additional Resources

- **WordPress Codex**: https://codex.wordpress.org/
- **Elementor Documentation**: https://elementor.com/help/
- **Three.js Documentation**: https://threejs.org/docs/
- **Theme Website**: https://axai.at

---

**Congratulations!** 🎉

Your AxAI Galaxy theme is now installed and configured. Enjoy creating with your stunning new website!

**Questions?** Visit https://axai.at

**Made with ❤️ by Ali Kutlusoy**