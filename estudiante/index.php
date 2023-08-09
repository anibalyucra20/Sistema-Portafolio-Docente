<?php

if (!isset($_SESSION['id_sesion_est'])) {
    echo "<script>
			
			window.location.replace('login/');
		</script>
		";
}