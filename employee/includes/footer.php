<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim(str_replace('\\', '/', $basePath), '/');
?>
<style>
    footer.footer-fixed {
        position: fixed;
        bottom: 0;
        left: 250px; /* same as sidebar width */
        right: 0;
        background-color: #343a40;
        color: white;
        padding: 10px 20px;
        z-index: 1030;
    }

    @media (max-width: 768px) {
        footer.footer-fixed {
            left: 0;
        }
    }

    body {
        padding-bottom: 60px; /* height of the footer to avoid overlap */
    }
</style>

<footer class="footer-fixed text-center">
    <p class="mb-0">&copy; <?= date("Y"); ?> Employee Management System. All rights reserved.</p>
</footer>

<script src="<?= $basePath ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
