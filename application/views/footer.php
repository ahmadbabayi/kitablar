<footer class="w3-dark-grey" id="myFooter">
    <div class="w3-container w3-padding">
        <div class="w3-third w3-center">
            <h5>Kitablar OPDS cataloge link:</h5>
            <input value="<?php echo base_url('opds'); ?>" size="25" readonly="" onclick="select()">            
        </div>
        <div class="w3-third w3-center">
            <h5>Find Us On</h5>
            <i class="w3-hover-opacity"><a href="https://t.me/kitablar" target="_blank"><img src="<?php echo base_url('images/telegram.png'); ?>" alt="Telegram"/></a></i>
        </div>
        <div class="w3-third w3-center">
            <h5>RSS feed</h5>
            <a href="<?php echo base_url('rss'); ?>" ><img alt="rss" src="<?php echo base_url('images/rss.gif'); ?>"></a>
        </div>
    </div>
    <div class="w3-container w3-center">
        <p>Powered by <a href="https://kitablar.com/" target="_blank">Kitablar.com</a></p>
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