<?php
use Coupa\LegalEntity\LegalEntityCollection;
use Coupa\User\User;

$hasSidebar = true;

require_once 'templates/header.php';

/** @var User $user */
/** @var LegalEntityCollection $legalEntityCollection */

$info      = json_decode($data);
$bandLevel = $info->loggedInUser->info->bandLevel;
$type      = $info->loggedInUser->info->type;
?>

<aside class="waiting dynamic-loaded">
    <!-- CONTENT WILL BE REPLACED WITH JS -->
</aside>
<div id="wrapper" class="waiting">
    <main>
        <div class="container" id="main-page">

            <?php
            if ($hasWaitingApprovals) {
                echo '  <div class="card" id="has-requests-hint">
                            <div class="hint">
                                <i class="material-icons">&#xE001;</i>
                                <p>You have some requests that require your approval. <a href="'.$router->pathFor('approve').'">Take action</a></p>
                            </div>
                        </div>';
            }
            ?>
            <div class="card hint hide no-children-margin" id="access-review-reminder">

            </div> <!-- /card -->
            <div id="new-design-top" class="hide">
                <span class=" pg-modal-open-modal" data-modal="what-can-the-app-do">
                    <i class="material-icons">info_outline</i>
                    <span class="faux-link">What can this app do?</span>
                </span>
            </div>
            <div class="card" id="new-design">
                <div class="tabbed-content">
                    <div class="tabs-wrapper">
                        <span class="tab active" data-content="coupa-profile"><i class="material-icons">person</i> Coupa Profile</span>
                        <span class="tab" data-content="roles"><i class="material-icons">supervisor_account</i> Roles</span>
                        <span class="tab" aria-hidden id="hidden-tab" data-content="purchases-buyer-access"><i class="material-icons">shopping_cart</i> Buyer Access</span>
                        <span class="tab" data-content="legal-entities"><i class="material-icons">account_balance</i> Legal Entities</span>
                        <span class="tab" data-content="approval-groups"><i class="material-icons">group</i> Approval Groups</span>
                    </div> <!-- /tabs-wrapper -->
                    <div class="overflow-wrapper">
                        <div class="content active" id="coupa-profile">
                            <div class="padding-15" id="coupa-profile-content">
                                <!-- /will be replaced with JS -->
                            </div> <!-- /padding-15 -->
                        </div> <!-- /content -->
                        <div class="content" id="roles">
                            <div class="padding-15" id="roles-content">
                                <!-- /will be replaced with JS -->
                            </div> <!-- /padding-15 -->
                        </div>
                        <div class="content" id="purchases-buyer-access">
                            <div class="" id="spend-pools-content">
                            </div> <!-- /padding-15 -->
                        </div>
                        <div class="content" id="legal-entities">
                            <div>
                                <div id="access-to-legal-entities-top">
                                    <!-- /will be replaced with JS -->
                                </div> <!-- /access-to-legal-entities-top -->

                                <div class="flex-table" id="access-to-legal-entities-table">
                                    <div class="row head">
                                        <div class="column">#</div>
                                        <div class="column">Code</div>
                                        <div class="column">Description</div>
                                        <div class="column">Country</div>
                                        <div class="column"></div>
                                    </div> <!-- /head -->
                                    <div class="flex-table-body">
                                        <!-- /will be replaced with JS -->
                                    </div> <!-- /flex-table-body -->
                                </div> <!-- /flex-table -->
                            </div>
                        </div>
                        <div class="content" id="approval-groups">
                            <div>
                                <div id="approval-groups-top">
                                    <!-- /will be replaced with JS -->
                                </div> <!-- /access-to-legal-entities-top -->

                                <div id="approval-groups-Search">
                                    <form id="approvalGroupSearchForm">
                                        <div class="input-wrapper">
                                            <label for="search-for-les">Find a group</label>
                                            <input type="text" name="searchTerm" placeholder="Enter a Group"/>
                                            <span class="helper">
                                                <i class="material-icons">info_outline</i>
                                                Type a group name to find out if you are part of it
                                            </span>
                                        </div> <!-- /input-wrapper -->
                                        <div class="col">
                                            <button class="button blue">
                                                <i class="material-icons">search</i>
                                                Search
                                            </button>
                                        </div>
                                    </form>
                                </div> <!-- /access-to-legal-entities-top -->

                                <div class="flex-table" id="approval-groups-table">
                                    <div class="row head">
                                        <div class="column">#</div>
                                        <div class="column">Description</div>
                                    </div> <!-- /head -->
                                    <div class="flex-table-body">
                                        <!-- /will be replaced with JS -->
                                    </div> <!-- /flex-table-body -->
                                </div> <!-- /flex-table -->
                            </div>
                        </div>
                    </div> <!-- /overflow-wrapper -->
                </div> <!-- /tabbed-content -->
            </div> <!-- /card -->
        </div> <!-- container -->
        <div class="pg-modal-wrap" id="register-user-modal">
            <div class="pg-modal med">
                <div class="content">
                    <div class="padding-15">
                        <div id="register-user-modal-body"></div>
                        <div class="button-wrapper">
                            <button class="button blue pg-modal-close-modal">
                                <i class="material-icons">&#xE5C4;</i>
                                Go back
                            </button>
                            <button class="button blue" id="submit-request">
                                <i class="material-icons">&#xE5CA;</i>
                                Submit Request
                            </button>
                        </div> <!-- /button-wrapper -->
                        <div class="form-submission">
                            <div class="hint loading has-border hide">
                                <img src="/assets/images/loading.gif" alt="Loading">
                                <span>Submitting your request. Thank you for your patience.</span>
                            </div>
                        </div> <!-- /form-submission -->
                    </div>
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="change-user-modal">
            <div class="pg-modal med">
                <div class="content">
                    <form id="change-user-form" class="padding-15" autocomplete="off">
                        <h2>Enter a user</h2>
                        <div class="input-wrapper old-style">
                            <input type="text" placeholder="Enter a user" id="userTerm" name="userTerm" list="previousUsers">
                            <div class="helper"><i class="material-icons">info_outline</i> You can search by full name, email, shortname, or t-number</div>
                            <datalist id="previousUsers"></datalist>
                        </div> <!-- /input-wrapper -->
                        <div class="button-wrapper">
                            <button class="button blue left-tooltip" id="change-user-button" data-tooltip="You must enter something" disabled>
                                <i class="material-icons">&#xE5CA;</i>
                                Select user
                            </button>
                        </div> <!-- /button-wrapper -->
                        <div class="form-submission">
                            <div class="hint loading has-border hide">
                                <img src="/assets/images/loading.gif" alt="Loading">
                                <span>Fetching results. Thank you for your patience.</span>
                            </div>
                        </div> <!-- /form-submission -->
                    </form> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="request-le-modal" data-action-type="">
            <div class="pg-modal med has-floating">
                <div class="content">
                    <div class="overflow-wrap">
                        <div class="overflow-content active" id="first">
                            <div class="padding-15">
                                <h2><span id="le-get-or-request"></span></h2>
                                <div class="flex-wrapper quick-search-wrap bottom">
                                    <div class="input-wrapper">
                                        <label for="search-for-les">Search for a legal entity</label>
                                        <input type="text" id="search-for-les" placeholder="Enter the legal entity you wish to find"/>
                                    </div> <!-- /input-wrapper -->
                                    <button class="button blue has-tooltip right-aligned" id="clear-quick-search" disabled data-tooltip="Search field is empty">
                                        <i class="material-icons">&#xE5CD;</i>
                                        Clear
                                    </button>
                                </div> <!-- /flex-wrapper -->
                            </div> <!-- /padding-15 -->
                            <div class="flex-table" id="legal-entities-table">
                                <div class="row head">
                                    <div class="column"></div>
                                    <div class="column" data-mobile-title="Legal Entity">
                                        Legal Entity
                                    </div> <!-- /column -->
                                    <div class="column" data-mobile-title="Country">
                                        Country
                                    </div> <!-- /column -->
                                </div> <!-- /head -->
                                <div class="flex-table-body">

                                    <?php

                                    $leCodes = $legalEntityCollection->extractPropertyArray('code');

                                    while ($legalEntityCollection->seek()) {
                                        $legalEntity = $legalEntityCollection->get();

                                        echo ' <div class="row">
                                            <div class="column">
                                                <div class="checkbox-wrapper">
                                                    <input type="checkbox" id="le-'.$legalEntity->getCode().'" value="'.$legalEntity->getCode().'" name="les" data-content-group="'.$legalEntity->getContentGroup().'">
                                                    <label for="le-'.$legalEntity->getCode().'">
                                                        <span class="checkbox"></span>
                                                    </label>
                                                </div> <!-- /checkbox-wrapper -->
                                            </div>
                                            <div class="column" data-mobile-title="Legal Entity">
                                                '.$legalEntity->getCode().' - ' .$legalEntity->getDescription().'
                                            </div>
                                            <div class="column" data-mobile-title="Country">
                                                '.$legalEntity->getCountry().'
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div> <!-- /flex-table-body -->
                                <div class="foot hide">
                                    <div class="table-is-empty">
                                        <i class="material-icons">&#xE88F;</i>
                                        There are no results that match your search term. Please try another search.
                                    </div> <!-- /table-is-empty -->
                                </div> <!-- /foot -->
                            </div> <!-- /flex-table -->
                        </div> <!-- /overflow-content -->
                        <div class="overflow-content right" id="second">
                            <div id="second-body"></div> <!-- /second-body -->
                        </div> <!-- /overflow-content -->
                    </div> <!-- /overflow-wrapper -->
                </div> <!-- /content -->
                <div class="floating">
                    <div class="flex-wrapper center between" id="le-step-1">
                        <button class="button cancel pg-modal-close-modal">
                            <i class="material-icons">&#xE5C4;</i>
                            Cancel
                        </button>
                        <button id="le-next-step-button" class="button blue right-icon has-tooltip right-aligned" disabled data-tooltip="You must select a legal entity">
                            <i class="material-icons">&#xE5C8;</i>
                            Next
                        </button>
                    </div>
                    <div class="flex-wrapper center between hide" id="le-step-2">
                        <button class="button cancel" id="back-to-step-1">
                            <i class="material-icons">&#xE5C4;</i>
                            Go back
                        </button>
                        <button class="button blue" id="submit-le-request">
                            <i class="material-icons">&#xE5CA;</i>
                            Submit
                        </button>
                    </div>
                    <div class="form-submission">
                        <div class="hint loading has-border hide">
                            <img src="/assets/images/loading.gif" alt="Loading">
                            <span>Submitting your request. Thank you for your patience.</span>
                        </div>
                    </div> <!-- /form-submission -->
                </div> <!-- /floating -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="reporting-role-modal">
            <div class="pg-modal med">
                <div class="content">
                    <div class="padding-15">
                        <h2>Confirm Request</h2>
                        <p>The Coupa reporting role allows a user to have read only ability to view transactional data.<br/>Do you wish to add this role?</p>
                        <div class="button-wrapper">
                            <button class="button cancel pg-modal-close-modal">
                                <i class="material-icons">&#xE5C4;</i>
                                Cancel
                            </button>
                            <button class="button blue" id="submit-reporting-role">
                                <i class="material-icons">&#xE5CA;</i>
                                Submit
                            </button> <!-- /button -->
                        </div> <!-- /button-wrapper -->
                        <div class="form-submission">
                            <div class="hint loading has-border hide">
                                <img src="/assets/images/loading.gif" alt="Loading">
                                <span>Submitting your request. Thank you for your patience.</span>
                            </div>
                        </div> <!-- /form-submission -->
                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /reporting-role-modal -->
        <div class="pg-modal-wrap" id="cannot-action-modal">
            <div class="pg-modal med">
                <div class="content">
                    <div class="padding-15">
                        <h2>You do not have access to do perform this action</h2>
                        <p>Sorry, only a non-emp's P&G sponsor can <span class="message-text"></span> for non-employees in Coupa.</p>
                        <div class="button-wrapper">
                            <button class="button blue pg-modal-close-modal">
                                <i class="material-icons">&#xE5C4;</i>
                                Close
                            </button>
                        </div> <!-- /button-wrapper -->
                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="le-not-allowed-modal">
            <div class="pg-modal small">
                <div class="content">
                    <?php $employeeType=$info->searchedUser->coupa->employeeType;
                    if(!isset($employeeType) || $employeeType == 'Non-Emp'){
                        $employee_type="non-employees";
                    } ?>
                    <div class="padding-15">
                            <h2>Unable to perform action</h2>
                            <p>Sorry, only the requested user's P&G Sponsor may assign LE's to this account.</p>
                            <p>Please escalate on the Coupa Access & Security <a href="https://web.yammer.com/main/groups/eyJfdHlwZSI6Ikdyb3VwIiwiaWQiOiIxNDM4Nzc0MyJ9/all">Yammer page</a> if additional support needed.</p>
                        <div class="button-wrapper">
                            <button class="button blue pg-modal-close-modal">
                                <i class="material-icons">&#xE5C4;</i>
                                Close
                            </button>
                        </div> <!-- /button-wrapper -->
                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div>
        <div class="pg-modal-wrap" id="le-not-allowed-modal-central-receiving">
            <div class="pg-modal small">
                <div class="content">
                    <div class="padding-15">
                            <h2>Unable to perform action - Assign LE to Central Receiver</h2>
                            <p>Sorry, <strong>non-employees</strong> and <strong>users</strong> with Coupa roles "Central Receiving" and/or "P&G Central Receiver w/o Requisitioning" do not have access to add Legal Entities directly in Coupa but must leverage the <a href="https://coupa-stage.pg.com/access/central-receiver">Central Receiver</a>  page to assign Site/Plant codes for each LE required.</p>
                            <p><strong>P&G Sponsors</strong> - maintain their non-employees site codes</p>
                            <p><strong>P&G Employees</strong> with Central receiver role - maintain their own site codes</p>
                       <div class="button-wrapper">
                            <button class="button blue pg-modal-close-modal">
                                <i class="material-icons">&#xE5C4;</i>
                                Close
                            </button>
                        </div> <!-- /button-wrapper -->
                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div>
        <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="pg-buyer-modal">
            <div class="pg-modal small">
                <div class="content">
                    <div class="padding-15">
                        <h2>Welcome P&G Buyer!</h2>
                        <p>Please proceed to <a href="/access/buyers" target="_blank">Coupa Buyer Access</a>.</p>
                        <div class="button-wrapper">
                            <button class="button blue pg-modal-close-modal">
                                <i class="material-icons">&#xE5C4;</i>
                                Close
                            </button>
                        </div> <!-- /button-wrapper -->
                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="register-info-modal">
            <div class="pg-modal">
                <div class="content">
                    <div class="padding-15 children-have-margin" id="info-modal-body">

                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="central-receiving-modal">
            <div class="pg-modal small">
                <div class="content">
                    <div class="padding-15 children-have-margin">
                        <h2>Please continue to Service Now</h2>
                        <p>Sorry, <span id="central-receiving-person" data-you="you are" data-other=" is">you are</span> a central receiver. Therefore, access to Legal Entities can only be requested using the <a href="https://pgglobalenterprise.service-now.com/fss/request_coupa_access.do" target="_blank">Service Now form</a>. Only employees have access to that form.</p>
                        <span class="button blue pg-modal-close-modal">
                            <i class="material-icons">&#xE317;</i>
                            Go Back
                        </span>
                    </div> <!-- /padding-15 -->
                </div> <!-- /content -->
            </div> <!-- /central-receiving-modal -->
        </div> <!-- /pg-modal-wrap -->

        <div class="pg-modal-wrap" id="extend-user-modal">
            <div class="pg-modal small">
                <div class="content">
                    <div class="padding-15" id="extend-user-body">

                    </div>
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->

        <div class="pg-modal-wrap" id="what-can-the-app-do">
            <div class="pg-modal large">
                <div class="content">
                    <div class="">
                        <h2>What users can currently do:</h2>
                        <div class="flex-table" id="who-can-do-what-table">
                            <div class="row head">
                                <div class="column">Feature</div>
                                <div class="column <?php echo $type == 'non-emp' ? 'highlight': ''; ?>"><i class="material-icons">person</i> Non-emps</div>
                                <div class="column <?php echo $type == 'employee' && $bandLevel < 3 ? 'highlight': ''; ?>"><i class="material-icons">person</i> Employees</div>
                                <div class="column <?php echo $bandLevel >= 3 ? 'highlight': ''; ?>"><i class="material-icons">person</i>P&G Sponsors</div>
                                <div class="column"></div>
                            </div> <!-- /row -->
                            <div class="flex-table-body">
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">View other users' profiles</div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Register employees</div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->

                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Add Legal Entities to Employees with Standard Access</div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Add Site Codes for those with a Central Receiver role</div>
                                    <div class="column" data-mobile-title="person"><em>-</em></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Assign the Central receiver w/o Requisitioning role</div>
                                    <div class="column" data-mobile-title="person"><em>-</em></div>
                                    <div class="column" data-mobile-title="person"><em>-</em></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Give employees the reporting role</div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Deactivate / reactivate users</div>
                                    <div class="column" data-mobile-title="person"><em>-</em></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">Register non-employees</div>
                                    <div class="column" data-mobile-title="person"><em>-</em></div>
                                    <div class="column" data-mobile-title="person"><em>-</em></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">P&G Sponsors</div>
                                </div> <!-- /row -->
                                <div class="row">
                                    <div class="column" data-mobile-title="Feature">View Access Review Status</div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="person"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="supervisor_account"><i class="material-icons">check</i></div>
                                    <div class="column" data-mobile-title="Can be done by:">Non-emps, Employees, P&G Sponsors</div>
                                </div> <!-- /row -->
                            </div> <!-- /flex-table-body -->
                        </div>

                        <div class="padding-15 children-have-margin">
                            <h2>Coupa Access special features:</h2>
                            <div class="special-feature-list">
                                <div class="feature">
                                    <i class="material-icons">email</i>
                                    <p>App sends email to relevant stakeholder most every change you make</p>
                                </div> <!-- /feature -->
                                <div class="feature">
                                    <i class="material-icons">supervised_user_circle</i>
                                    <p>App sends your request for people that are linked to a restricted site for approval to designated site approvers</p>
                                </div> <!-- /feature -->
                                <div class="feature">
                                    <i class="material-icons">assignment_turned_in</i>
                                    <p>App automatically check's if non-emps's company has a valid CDA</p>
                                </div> <!-- /feature -->
                                <div class="feature">
                                    <i class="material-icons">check_circle_outline</i>
                                    <p>App verifies CDA is on-file for non-employee request</p>
                                </div> <!-- /feature -->
                            </div>
                            <button class="button blue pg-modal-close-modal">
                                <i class="material-icons">close</i>
                                Close
                            </button>
                        </div>

                    </div>
                </div> <!-- /padding-15 -->
            </div> <!-- /pg-modal-small -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="deactivate-modal">
            <div class="pg-modal small">
                <div class="content padding-15" id="deactivate-modal-content"></div>
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="remove-le-modal">
            <div class="pg-modal med has-floating" id="remove-le-content">
                <!-- CONTENT WILL BE REPLACED WITH JS -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="reactivate-modal">
            <div class="pg-modal small">
                <div class="content padding-15" id="reactivate-modal-content"></div>
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="confirm-review-modal">
            <div class="pg-modal small">
                <div class="content padding-15" id="confirm-review-content">
                    <h2>Confirm access review</h2>
                    <p>Please confirm submission of this access review. Once confirmed, this action cannot be undone.</p>
                    <div id="prerequisite-roles-summary">
                        <p><strong class="secondary">Linked roles:</strong></p>
                        <p>fdasfdfd</p>
                    </div>
                    <div id="keep-roles-summary">
                        <p><strong class="secondary">Keep roles:</strong></p>
                        <p>fdfdsfd</p>
                    </div>
                    <div id="remove-roles-summary">
                        <p><strong class="secondary">Remove roles:</strong></p>
                        <p>fdasfdfd</p>
                    </div>
                    <div class="button-wrapper">
                        <button class="button cancel pg-modal-close-modal">
                            <i class="material-icons">arrow_back</i>
                            Go back
                        </button>
                        <button class="button blue" id="confirm-review-access">
                            <i class="material-icons">check</i>
                            Submit
                        </button>
                    </div> <!-- /button-wrapper -->
                    <div class="form-submission">
                        <div class="hint loading has-border hide">
                            <img src="/assets/images/loading.gif" alt="Loading">
                            <span>Submitting your request. Thank you for your patience.</span>
                        </div>
                    </div> <!-- /form-submission -->
                </div> <!-- /content -->
            </div> <!-- /pg-modal -->
        </div> <!-- /pg-modal-wrap -->
        <div class="pg-modal-wrap" id="confirm-buyer-access-modal">
            <div class="pg-modal small">
                <div class="content padding-15">
                    <h2>Confirm submission</h2>
                    <p>Please confirm that you have reviewed your choices and wish to submit this request. Once submitted, this action cannot be undone.</p>
                    <p>It will take a few minutes for the submission to process.</p>
                    <div class="button-wrapper">
                        <div class="flex-wrapper center">
                            <button class="button cancel pg-modal-close-modal">
                                <i class="material-icons">arrow_back</i>
                                Go back
                            </button>
                            <button class="button blue" id="submit-buyer-step-3">
                                <i class="material-icons">check</i>
                                Submit
                            </button>
                        </div> <!-- /flex-wrapper -->
                    </div> <!-- /button-wrapper -->
                    <div class="form-submission">
                        <div class="loading hint has-border hide">
                            <img src="/assets/images/loading.gif" alt="Loading"/>
                            <p>Submitted your buyer access request. Thank you for your patience.</p>
                        </div> <!-- /hint -->
                    </div> <!-- /fomr-submission -->
                </div> <!-- /content -->
            </div> <!-- pg-modal -->
        </div> <!-- /confirm-buyer-access-modal -->

        <input type="hidden" id="json-data" value='<?php echo str_replace("'", "&#39;", $data); ?>'/>


        <?php require_once 'templates/footer.php'; ?>
