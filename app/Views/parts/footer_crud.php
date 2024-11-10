<script src="<?=base_url()?>assets/js/sidebar-menu.js"></script>
    <script src="<?=base_url()?>assets/js/feather.min.js"></script>
    <script src="<?=base_url()?>assets/js/simplebar.min.js"></script>
    <script src="<?=base_url()?>assets/js/custom/custom.js"></script>


<style>
    .cls{
    position: absolute;
    background: white;
    border-radius: 40px;
    margin: -10px -10px;
    }
</style>

</body>



<script>
    $(".UserTab").parent("a").click(function(e) {
        e.preventDefault();
        let url = $(this).attr("href");

        const width = 500;
        const height = 500;
        const left = (screen.width - width) / 2;
        const top = (screen.height - height) / 2;

        // باز کردن پنجره جدید با تنظیمات ابعاد و مکان
        window.open(url, '_blank', `width=${width},height=${height},top=${top},left=${left}`);

    })




    $(".DriverTab").parent("a").click(function(e) {
        e.preventDefault();
        let url = $(this).attr("href");

        const width = 580;
        const height = 800;
        const left = (screen.width - width) / 2;
        const top = (screen.height - height) / 2;

        // باز کردن پنجره جدید با تنظیمات ابعاد و مکان
        window.open(url, '_blank', `width=${width},height=${height},top=${top},left=${left}`);

    })
</script>



</html>
