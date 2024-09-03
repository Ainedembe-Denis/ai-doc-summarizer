<?php

function htmlScriptTagJsApi($siteKey)
{
    return '<script src="https://www.google.com/recaptcha/enterprise.js?render=' . $siteKey . '"></script>';
}