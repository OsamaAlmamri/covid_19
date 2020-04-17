<script>
    function pusher_init() {
        var pusher = new Pusher('3a689a4f0680cadc8591', {
            cluster: 'us3',
            forceTLS: true
        });
        Pusher.logToConsole = true;
        return pusher;
    }
</script>
