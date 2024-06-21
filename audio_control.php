<?php
echo '<script>
  const audioIcon = document.getElementById("audio-icon");
  const audio = document.getElementById("background-audio");

  audioIcon.addEventListener("click", () => {
    if (audio.paused) {
      audio.play();
    } else {
      audio.pause();
    }
  });
</script>';
?>
