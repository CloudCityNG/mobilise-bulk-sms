<nav class="header sm-header dark" data-pages="header" data-pages-header="autoresize">
  <div class="container relative">

    <div class="pull-left z-index-1">

      <div class="visible-sm-inline visible-xs-inline menu-toggler pull-right " data-pages="header-toggle" data-pages-element="#header">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
      </div>
    </div>

    <div class="pull-center">
      <div class="pull-center-inner">
        <div class="header-inner ">

          <img src="/pages/assets/images/logo-transparent-155x26.png" width="155" height="26" data-src-retina="/pages/assets/images/logo-transparent-155x26_2x.png" alt="">
        </div>
      </div>
    </div>


    <div class=" menu-content clearfix" data-pages="menu-content" data-pages-direction="slideLeft" id="header">

      <div class="pull-left">
        <a href="#" class="text-black link padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10 on" data-pages="header-toggle" data-pages-element="#header">
          <i class=" pg-close_line"></i>
        </a>
      </div>
      <div class="pull-left sm-block sm-full-width">
        <div class="header-inner">

          <ul class="menu">
            <li class="horizontal">
              <a href="javascript:;" data-text="Messaging" class="active">Messaging <i class="pg-arrow_minimize m-l-5"></i></a>
              <nav class="horizontal">
                <span class="arrow"></span>
                <ul>
                  <li><a href="#">Quick SMS</a></li>
                  <li><a href="#">Bulk SMS</a></li>
                </ul>
              </nav>
            </li>

            <li><a href="#" data-text="Address-book" class="active">Address-book</a></li>

            <li class="horizontal">
              <a href="javascript:;" data-text="Elements">Records <i class="pg-arrow_minimize m-l-5"></i></a>
              <nav class="horizontal">
                <span class="arrow"></span>
                <ul>
                  <li>
                    <a href="#" target="_blank">Sent SMS</a>
                  </li>
                  <li>
                    <a href="#" target="_blank">Draft SMS</a>
                  </li>
                </ul>
              </nav>
            </li>
          </ul>

        </div>
      </div>
      <div class="pull-right sm-block sm-full-width">
        <div class="header-inner">

          <ul class="menu">
            <li class="classic">
              <a href="javascript:;" data-text="{{ucfirst($currentUser->username)}}">
                {{$currentUser->username}} <i class="pg-arrow_minimize m-l-5"></i>
              </a>
              <nav class="classic">
                <span class="arrow"></span>
                <ul>
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Security</a></li>
                  <li><a href="#">Notifications</a></li>
                </ul>
              </nav>
            </li>

          </ul>

          <div class="font-arial m-l-35 m-r-35 m-b-20  visible-sm visible-xs m-t-30">
            <p class="fs-11 no-margin small-text p-b-20">Exclusive only at ,Themeforest. See Standard licenses &amp; Extended licenses
            </p>
            <p class="fs-11 small-text muted">Copyright &copy; 2014 REVOX</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</nav>
