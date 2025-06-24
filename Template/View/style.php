<!--
  Core Framework - Template File

  @license    MIT (https://mit-license.org/)
  @author     Louis Ouellet <louis@laswitchtech.com>
-->
<style>
    body {
        <?php if($this->Config->get('application','theme') === 'glass'): ?>
            /* Gradient Background */
            background-image: none !important;
            background-color: none !important;
            background: linear-gradient(45deg, <?= $this->Config->get('style','gradient-start') ?>, <?= $this->Config->get('style','gradient-end') ?>)!important;
            background-attachment: fixed !important;
        <?php endif; ?>
    }
    #sidebar {
        width: 300px;
    }
    #sidebar.collapsing {
        width: 0px;
    }
    #content {
        margin-left: 300px;
        width: calc(100vw - 300px);
        transition: 300ms ease;
    }
</style>
