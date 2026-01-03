<?php
defined( 'ABSPATH' ) || exit;

use NexaWP\Frontend\Footer;
use NexaWP\Frontend\Layout;

Layout::content_close();
Footer::render();

wp_footer();
?>
</body>
</html>