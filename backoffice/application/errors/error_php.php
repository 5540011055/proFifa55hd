<div class="ui-widget">
    <div class="ui-state-error ui-corner-all" style="padding: 2px;font-size: 14px;">
        <p>
            <span class="ui-icon ui-icon-alert" style="float: left; margin-right: 2px"></span>
            <strong>A PHP Error was encountered:</strong><br /> 
            <p>Severity: <?php echo $severity; ?></p>
            <p>Message:  <?php echo $message; ?></p>
            <p>Filename: <?php echo $filepath; ?></p>
            <p>Line Number: <?php echo $line; ?></p>
        </p>
    </div>
</div>