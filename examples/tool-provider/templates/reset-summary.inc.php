<?php

/*

    A responsible developer would restrict access to this page using, for
    example, HTTP Auth or some other authentication approach. Random folks
    with URLs shouldn't be able to reset _your_ authentication system! And
    that's what this page does: it reload `config.xml` and then creates
    a dummy Tool Consumer (TC) and then presents their credentials to
    that browser. Woo! That would be bad if it got into the wrong hands, huh?

 */

require_once 'common.inc.php';

use Battis\DataUtilities;

function createUrl($action)
{
    return DataUtilities::URLfromPath(dirname(__DIR__)) . "?action=$action";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $toolbox->config('TOOL_NAME') ?></title>
    </head>
    <style>
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }
        td, th {
            border: solid 1px #ddd;
            padding: 1em;
        }
    </style>
    <body>
        <h1><?= $toolbox->config('TOOL_NAME') ?></title>

        <h2>Tool Consumers</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Key</th>
                    <th>Secret</th>
                </th>
            </thead>
            <tbody>
                <?php

                foreach ($toolbox->lti_getConsumers() as $consumer) {
                    echo "
                        <tr>
                            <td>{$consumer->name}</td>
                            <td>{$consumer->getKey()}</td>
                            <td>{$consumer->secret}</td>
                        </tr>
                    ";
                }
                
                ?>
            </tbody>
        </table>

        <h2>LTI Configuration XML</h2>

        <p>Provide this URL to Canvas when configuring a new app by URL.</p>

        <p>
            <a href="<?= createUrl('config'); ?>"><?= createUrl('config') ?></a>
        </p>

        <h2>Reset from <code>config.xml</code></h2>

        <p>
            <a href="<?= createUrl('reset'); ?>"><?= createUrl('reset') ?></a>
        </p>
    </body>
</html>
