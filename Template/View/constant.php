<script>
    var CSRF_KEY = "<?= $this->CSRF->key() ?>";
    var CSRF_TOKEN = "<?= $this->CSRF->token() ?>";
    const PUBLIC = <?= $this->public() ? 'true' : 'false' ?>;
    const AUTHENTICATED = <?= $this->Auth->isAuthenticated() ? 'false' : 'false' ?>;
    <?php if($this->Auth->isAuthenticated()): ?>
        const USER_ID = <?= $this->Auth->user()->id ?>;
        const USER_USERNAME = "<?= $this->Auth->user()->username ?>";
        const USER_ORGANIZATION = "<?= $this->Auth->user()->organization()->id ?>";
        const USER_TOKEN = "<?= $this->Auth->user()->token() ?>";
        const USER_ROLES = <?= json_encode($this->Auth->user()->roles()) ?>;
        const DEV_MODE = <?= json_encode($this->Auth->isAuthorized('Developer',1)) ? 'true' : 'false' ?>;
        const ADMIN_MODE = <?= json_encode($this->Auth->isAuthorized('Administrator',1)) ? 'true' : 'false' ?>;
    <?php else: ?>
        const USER_ID = null;
        const USER_USERNAME = null;
        const USER_ORGANIZATION = null;
        const USER_TOKEN = null;
        const USER_ROLES = null;
        const DEV_MODE = null;
        const ADMIN_MODE = null;
    <?php endif; ?>
</script>
