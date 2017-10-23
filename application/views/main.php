<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>US Internet Development</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/bootstrap-3.0.3/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/css/main.css"/>
    <script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>resources/bootstrap-3.0.3/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>resources/js/main.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="row top-space create-account-panel">
                <button type="button" id="createAccountBtn" class="btn btn-primary">Create Account</button>
                <div id="createAccountPanel" class="hidden panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="Main/createAccount" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2">First Name: </label>
                                <div class="col-sm-10">
                                    <input type="text" name="firstName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Last Name: </label>
                                <div class="col-sm-10">
                                    <input type="text" name="lastName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Email: </label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Account Type: </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="accountTypeId">
                                        <?php
                                            foreach ($accountTypes as $type){
                                                echo
                                                    '<option value="' . $type->id . '">' . $type->account_type . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Done</button>
                                <button type="button" id="closeFormBtn" class="btn btn-danger">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row top-space">
                <h3>ACCOUNTS</h3>
                <ul class="nav nav-tabs" id="tabs">
                    <li role="presentation" class="active"><a href="#" data-panel="#allPanel">All</a></li>
                    <li role="presentation"><a href="#" data-panel="#inactivePanel">Inactive</a></li>
                </ul>
                <div class="panel tab-panels">
                    <div id="allPanel">
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>ACCOUNT TYPE</th>
                                <th>DESCRIPTION</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                            <?php
                                $count = 1;
                                foreach ($accounts as $account) { ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $account->first_name; ?></td>
                                        <td><?php echo $account->last_name; ?></td>
                                        <td><?php echo $account->email; ?></td>
                                        <td><?php echo $account->account_type; ?></td>
                                        <td><?php echo $account->description; ?></td>
                                        <td><?php echo $account->place; ?></td>
                                        <td>
                                            <?php
                                            if (strcmp($account->place,'confirmed') === 0){
                                                ?>
                                                <a href="#" id="toSetup" data-value="<?php echo $account->id; ?>" data-toggle="modal" data-target="#setupModal">Setup</a>
                                                <?php
                                            } else if (strcmp($account->place,'setup') === 0){
                                                ?>
                                                <a href="#" id="toActivated" data-value="<?php echo $account->id; ?>" data-toggle="modal" data-target="#setupModal">Activate</a>
                                                <br>
                                                <a href="Main/deactivate/<?php echo $account->id.'/'.$account->place; ?>" id="deactivate" data-value="<?php echo $account->id; ?>">Cancel</a>
                                                <?php
                                            } else if (strcmp($account->place,'activated') === 0){
                                                ?>
                                                <a href="Main/deactivate/<?php echo $account->id.'/'.$account->place; ?>" id="deactivate" data-value="<?php echo $account->id; ?>">Deactivate</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                            <?php } ?>
                        </table>
                        <div id="setupModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Log Message</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" action="" role="form">
                                            <div class="form-group">
                                                <input type="hidden" name="accountId" id="accountIdHidden">
                                                <textarea id="toSetupMsg" class="form-control" placeholder="Log a message here..." name="message" required></textarea>
                                                <button class="btn btn-xs btn-default" type="submit">Go</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="inactivePanel">
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>ACCOUNT TYPE</th>
                                <th>DESCRIPTION</th>
                                <th>STATUS</th>
                            </tr>
                            <?php
                                $count = 1;
                                foreach ($accounts as $account) {
                                if (!$account->active && strcmp($account->place,'deactivated') !== 0) {
                                ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $account->first_name; ?></td>
                                    <td><?php echo $account->last_name; ?></td>
                                    <td><?php echo $account->email; ?></td>
                                    <td><?php echo $account->account_type; ?></td>
                                    <td><?php echo $account->description; ?></td>
                                    <td><?php echo $account->place; ?></td>
                                </tr>
                            <?php } } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <h3>RECENT ACTIVITIES</h3>
            <ol class="breadcrumb" id="activityBreadcrumb">
                <li class="breadcrumb-item active"><a href="#" data-panel="#dayPanel">1 day</a></li>
                <li class="breadcrumb-item"><a href="#" data-panel="#weekPanel">1 week</a></li>
                <li class="breadcrumb-item"><a href="#" data-panel="#monthPanel">1 month</a></li>
            </ol>
            <div class="panel">
                <div class="activityPanel" id="dayPanel">
                    <ul class="list-unstyled activities-list">
                        <?php
                        foreach ($transitions as $trans){
                            if ((time()-(60*60*24)) < strtotime($trans->timestamp)){
                                $text = $trans->first_name . ' moved account from ' . $trans->from .
                                    ' to ' . $trans->to;
                                if ($trans->message !== null)
                                    $text .= ' with log message "'. $trans->message . '"';
                                echo '<li>' . $text . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="activityPanel hidden" id="weekPanel">
                    <ul class="list-unstyled activities-list">
                        <?php
                        foreach ($transitions as $trans){
                            if (date('M Y d', strtotime('-1 weeks')) < strtotime($trans->timestamp)){
                                $text = $trans->first_name . ' moved account from ' . $trans->from .
                                    ' to ' . $trans->to;
                                if ($trans->message !== null)
                                    $text .= ' with log message "'. $trans->message . '"';
                                echo '<li>' . $text . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="activityPanel hidden" id="monthPanel">
                    <ul class="list-unstyled activities-list">
                        <?php
                        foreach ($transitions as $trans){
                            if (date('M Y d', strtotime('-1 months')) < strtotime($trans->timestamp)){
                                $text = $trans->first_name . ' moved account from ' . $trans->from .
                                    ' to ' . $trans->to;
                                if ($trans->message !== null)
                                    $text .= ' with log message "'. $trans->message . '"';
                                echo '<li>' . $text . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>