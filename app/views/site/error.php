<?php
/**
 * @var Exception $exception
 */

?>
<div class="alert alert-danger border border-danger p-3" role="alert">
    <h4 class="alert-heading text-center">
        <i class="bi bi-dash-circle fa-2 mb-3"></i>
        <strong class="text-uppercase fs-3">Error</strong>
    </h4>
    <hr>
    <span class="d-block mt-2 fs-5">There was a problem with your request.</span>
    <small class="d-block text-muted">Please try again later.</small>
    <span class="d-block mt-2 fs-5"><?= $exception->getMessage() ?></span>
    <pre class="my-3" style="font-size: 0.8rem; overflow-x: auto;">
        Stack Trace:
        <?= $exception->getTraceAsString() ?>
    </pre>
</div>

