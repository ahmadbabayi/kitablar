<footer id="myFooter">
            <div class="w3-container w3-center">
                <p>Powered by <a href="http://www.kitablar.com/" target="_blank">Kitablar.com</a></p>
                <a href="<?php echo base_url('rss'); ?>" ><img alt="rss" src="<?php echo base_url('images/rss.gif'); ?>"></a>
            </div>
        </footer>

        <!-- END MAIN -->

    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
            } else {
                mySidebar.style.display = 'block';
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
        }
    </script>

</body>
</html>