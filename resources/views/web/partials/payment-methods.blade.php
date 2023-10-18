<div class="col-lg-12 px-0">
    <div class="heading_s1">
        <h4>Métodos De Pago</h4>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 p-md-5 mb-4 mb-md-5">
        <!-- Credit card form tabs -->
        <ul id="tabsMethodPayment" role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                    <i class="fa fa-credit-card"></i>
                    Tarjeta de crédito / débito
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-cash" class="nav-link rounded-pill">
                    <i class="fas fa-money-bill-alt"></i>
                    Efectivo
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                    <i class="fa fa-university"></i>
                    Transferencia
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                    <i class="fa fa-paypal"></i>
                    PayPal
                </a>
            </li>
        </ul>
        <!-- Credit card form content -->
        <div class="tab-content">
            <!-- Credit card info-->
            <div id="nav-tab-card" class="tab-pane fade show active">
                <!--Input for Token-->
                <input type="hidden" id="token_id" name="token_id">
                <div class="form-group">
                    <label for="username">Nombre del tarjetahabiente</label>
                    <input type="text" data-conekta="card[name]" placeholder="EJ. Juan Pérez" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="cardNumber">Número de tarjeta</label>
                    <div class="input-group">
                        <input type="text" maxlength="16" minlength="16" data-conekta="card[number]" placeholder="Número a 16 dígitos" class="form-control" required>
                        <div class="input-group-append icons-type-card">
                            <span class="input-group-text text-muted">
                                <i class="fa fa-cc-visa mx-1"></i>
                                <i class="fa fa-cc-amex mx-1"></i>
                                <i class="fa fa-cc-mastercard mx-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label><span class="hidden-xs">Fecha expiración</span></label>
                            <div class="input-group">
                                <input type="number" data-conekta="card[exp_month]" placeholder="MM" name="" class="form-control" required>
                                <input type="number" data-conekta="card[exp_year]" placeholder="AA" name="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-4">
                            <label data-toggle="tooltip" title="Código de tres dígitos en el reverso de su tarjeta">CVV
                                <i class="fa fa-question-circle"></i>
                            </label>
                            <input type="text" maxlength="4" minlength="3" placeholder="CVV" data-conekta="card[cvc]" required class="form-control">
                        </div>
                    </div>
                </div>
                <button type="button" id="button-pay-card" class="subscribe shadow-sm btn btn-fill-out btn-block">
                    @lang('cart.finish')
                </button>
            </div>
            <!-- Bank transfer info -->
            <div id="nav-tab-cash" class="tab-pane fade">
                <h6 class="mb-3">Envía tu comprobante de pago.</h6>
                <dl>
                    <dt>BBVA</dt>
                    <dd>Tarjeta: Cuenta Principal</dd>
                    {{-- <dd>4152-3137-7857-6350</dd> --}}
                    <dd>4152-3139-1706-0381</dd>
                    <dd>Tarjeta: Segunda opción</dd>
                    <dd>4152-3136-5573-9352</dd>
                </dl>
                <dl>
                    <dt>CITIBANAMEX</dt>
                    <dd>Tarjeta: Tercera opción</dd>
                    <dd>5204-1649-0800-7096</dd>
                </dl>
                <p class="text-muted">Notificar tu pago al correo: ventas@Zoofish.com.mx</p>
                <button type="button" id="button-pay-cash" class="subscribe shadow-sm btn btn-fill-out btn-block">
                    @lang('cart.finish')
                </button>
            </div>
            <!-- Bank transfer info -->
            <div id="nav-tab-bank" class="tab-pane fade">
                <h6 class="mb-3">Envía tu comprobante de pago. <br>Transferencia:</h6>
                <dl>
                    <dt>BBVA</dt>
                    <dd> CTA: 0191813234 CLABE: 0123-2000-1918-1323-42</dd>
                </dl>
                <dl>
                    <dt>CITIBANAMEX</dt>
                    <dd>CUENTA: 5942788 CLABE: 002320700659427889</dd>
                </dl>
                <p class="text-muted">Notificar transferencia al correo: ventas@zoofish.com.mx</p>
                <button type="button" id="button-pay-bank" class="subscribe shadow-sm btn btn-fill-out btn-block">
                    @lang('cart.finish')
                </button>
            </div>
            <!-- Paypal info -->
            <div id="nav-tab-paypal" class="tab-pane fade text-center">
                <p>PayPal es la forma más fácil de pagar en línea</p>
                <p><div class="my-3" id="paypal-button-container"></div></p>
                <p class="text-muted">Pagar con PayPal es completamente seguro y fácil.
                    Inicia sesión en tu cuenta de PayPal
                </p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 px-0 text-center">
    <h5 style="margin-top: 10px;">
        Si tienes algún problema al realizar tu pedido, duda o necesitas
        asistencia técnica o soporte, comunícate con nosotros. Te atenderemos lo
        antes posible.
    </h5>
    <a href="https://api.whatsapp.com/send?phone=+523316930836&text=Hola%21%20quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Zoofish%20😊❤️." target="_blank">
        <h5 style="margin-top:10px;">
            Comúnicate vía WhatsApp para agilizar la atención. <i style="font-size: 30px; margin-top:10px;" class="fa fa-whatsapp" aria-hidden="true"></i>
        </h5>
    </a>
</div>