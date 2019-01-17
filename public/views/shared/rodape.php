<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
?>

</main>

<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
                <i class="icon-list"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                <i class="icon-speech"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                <i class="icon-settings"></i>
            </a>
        </li>
    </ul>
    <!-- Tab panes-->
    <div class="tab-content">
        <div class="tab-pane active" id="timeline" role="tabpanel">
            <div class="list-group list-group-accent">
                <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Today</div>
                <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                    <div class="avatar float-right">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Meeting with
                        <strong>Lucas</strong>
                    </div>
                    <small class="text-muted mr-3">
                        <i class="icon-calendar"></i>  1 - 3pm</small>
                    <small class="text-muted">
                        <i class="icon-location-pin"></i>  Palo Alto, CA</small>
                </div>
                <div class="list-group-item list-group-item-accent-info">
                    <div class="avatar float-right">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/4.jpg" alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Skype with
                        <strong>Megan</strong>
                    </div>
                    <small class="text-muted mr-3">
                        <i class="icon-calendar"></i>  4 - 5pm</small>
                    <small class="text-muted">
                        <i class="icon-social-skype"></i>  On-line</small>
                </div>
                <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Tomorrow</div>
                <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
                    <div>New UI Project -
                        <strong>deadline</strong>
                    </div>
                    <small class="text-muted mr-3">
                        <i class="icon-calendar"></i>  10 - 11pm</small>
                    <small class="text-muted">
                        <i class="icon-home"></i>  creativeLabs HQ</small>
                    <div class="avatars-stack mt-2">
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/2.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/3.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/4.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/5.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/6.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <div class="list-group-item list-group-item-accent-success list-group-item-divider">
                    <div>
                        <strong>#10 Startups.Garden</strong> Meetup</div>
                    <small class="text-muted mr-3">
                        <i class="icon-calendar"></i>  1 - 3pm</small>
                    <small class="text-muted">
                        <i class="icon-location-pin"></i>  Palo Alto, CA</small>
                </div>
                <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
                    <div>
                        <strong>Team meeting</strong>
                    </div>
                    <small class="text-muted mr-3">
                        <i class="icon-calendar"></i>  4 - 6pm</small>
                    <small class="text-muted">
                        <i class="icon-home"></i>  creativeLabs HQ</small>
                    <div class="avatars-stack mt-2">
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/2.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/3.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/4.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/5.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/6.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img class="img-avatar" src="<?= URL_IMG ?>avatars/8.jpg" alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane p-3" id="messages" role="tabpanel">
            <div class="message">
                <div class="py-3 pb-5 mr-3 float-left">
                    <div class="avatar">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted float-right mt-1">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-3 pb-5 mr-3 float-left">
                    <div class="avatar">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted float-right mt-1">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-3 pb-5 mr-3 float-left">
                    <div class="avatar">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted float-right mt-1">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-3 pb-5 mr-3 float-left">
                    <div class="avatar">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted float-right mt-1">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
            <hr>
            <div class="message">
                <div class="py-3 pb-5 mr-3 float-left">
                    <div class="avatar">
                        <img class="img-avatar" src="<?= URL_IMG ?>avatars/7.jpg" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Lukasz Holeczek</small>
                    <small class="text-muted float-right mt-1">1:52 PM</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
            </div>
        </div>
        <div class="tab-pane p-3" id="settings" role="tabpanel">
            <h6>Settings</h6>
            <div class="aside-options">
                <div class="clearfix mt-4">
                    <small>
                        <b>Option 1</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox" checked="">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
                <div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                </div>
            </div>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>Option 2</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
                <div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                </div>
            </div>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>Option 3</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
            </div>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>Option 4</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox" checked="">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
            </div>
            <hr>
            <h6>System Utilization</h6>
            <div class="text-uppercase mb-1 mt-4">
                <small>
                    <b>CPU Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">348 Processes. 1/4 Cores.</small>
            <div class="text-uppercase mb-1 mt-2">
                <small>
                    <b>Memory Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">11444GB/16384MB</small>
            <div class="text-uppercase mb-1 mt-2">
                <small>
                    <b>SSD 1 Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">243GB/256GB</small>
            <div class="text-uppercase mb-1 mt-2">
                <small>
                    <b>SSD 2 Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">25GB/256GB</small>
        </div>
    </div>
</aside>
</div>
<footer class="app-footer">
    <div class="mx-auto">
        <a href="https://coreui.io">Todos os direitos reservados</a>
        <span>&copy; <?= date("Y") ?></span>
    </div>
</footer>

<link href="<?= URL_PUBLIC ?>vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="<?= URL_PUBLIC ?>vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?= URL_CSS ?>estilo-painel.css" rel="stylesheet">
<!-- CoreUI and necessary plugins-->
<script src="<?= URL_PUBLIC ?>vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/popper.js/dist/popper.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/pace-progress/pace.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/@coreui/coreui/dist/js/coreui.min.js"></script>

<?php

    if (!empty($this->dados->input_drop)) {
        ?>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/fileinput.min.js"></script>
        <!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/themes/fa/theme.js"></script>
        <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/locales/pt-BR.js"></script>

<?php
    }

?>

<?php

if (!empty($this->dados->validation)) {
    ?>

    <script src="<?= URL_PUBLIC ?>vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="<?= URL_PUBLIC ?>vendors/jquery-validate/localization/messages_pt_PT.js"></script>

<?php
}

?>

<script src="<?= URL_JS ?>scripts-painel.js"></script>
</body>
</html>