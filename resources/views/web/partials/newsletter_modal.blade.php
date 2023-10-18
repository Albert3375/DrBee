<!-- Home Popup Section -->
<div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="popup_content">
                            <div class="popup-text">
                                <div class="heading_s3 text-center">
                                    <h4>@lang('home.suscribe')</h4>
                                </div>
                                <p>@lang('home.newsletter')</p>
                            </div>
                                {!! Form::open(['url'=>'news_letter', 'class'=>'rounded_input','method'=>'GET']) !!}
                                    <div class="form-group">
                                        <input type="text" name="name" required class="form-control" placeholder=@lang('home.name')>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" required class="form-control" placeholder=@lang('home.email')>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-line btn-block text-uppercase btn-radius" title="Subscribe" name="submit" value="Submit">@lang('home.suscribe_btn')</button>
                                    </div>
                                {!! Form::close() !!}
                            </form>
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="modalOff" value="true">
                                    <label class="form-check-label" for="modalOff"><span>@lang('home.dont_show')</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>
</div>
<!-- End Screen Load Popup Section -->
