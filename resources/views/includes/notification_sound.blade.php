<script>
    function playSound() {
        var mp3Source = '<source src="{{HostUrl('')}}/1.mp3" type="audio/mpeg">';
        var oggSource = '<source src="{{HostUrl('')}}/1.ogg" type="audio/ogg">';
        var embedSource = '<embed hidden="true" autostart="true" loop="false" src="{{HostUrl('')}}/1.mp3">';
        document.getElementById("sound").innerHTML = '<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
    }
</script>
