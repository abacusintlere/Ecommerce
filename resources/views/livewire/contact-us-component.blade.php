<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>Contact us</span></li>
        </ul>
    </div>
    <div class="row">
        <div class=" main-content-area">
            <div class="wrap-contacts ">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    @if (Session::has('send_message'))
                        <div class="alert alert-success" role="alert">{{ $message }}</div>
                    @endif
                    <div class="contact-box contact-form">
                        <h2 class="box-title">Leave a Message</h2>
                        <form action="#" method="get" name="frm-contact" wire:submit.prevent='sendMessage'>

                            <label for="name">Name<span>*</span></label>
                            <input type="text" value="" id="name" name="name" wire:model='name'>

                            <label for="email">Email<span>*</span></label>
                            <input type="text" value="" id="email" name="email" wire:model='email'>

                            <label for="phone">Number Phone</label>
                            <input type="text" value="" id="phone" name="phone" wire:model='phone'>

                            <label for="comment">Comment</label>
                            <textarea name="comment" id="comment" wire:model='comment'></textarea>

                            <input type="submit" name="ok" value="Submit">

                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-info">
                        <div class="wrap-map">
                            <iframe src="{{ $settings->map }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <h2 class="box-title">Contact Detail</h2>
                        <div class="wrap-icon-box">

                            <div class="icon-box-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Email</b>
                                    <p>{{ $settings->email }}</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Phone</b>
                                    <p>{{ $settings->phone }}</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Mail Office</b>
                                    <p>{{ $settings->address }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end main products area-->

    </div>
    <!--end row-->

</div>
<!--end container-->