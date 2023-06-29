<!-- Booking -->
<div class="bottom-panel bottom-panel--floating">
    <form class="bottom-panel__wrap d-flex">
        <div class="row bottom-panel__form-wrap">
            <div class="form-group col-date-to col-12 col-sm-6 col-md-4 slash">
                <label class="labelFeature" for="check-in">Check in</label>
                <input type="text" class="inputFeature input-arrow readonly js-datepicker" id="check-in" name="check-in" placeholder="Select..." required="required" autocomplete="off">
            </div>
            <div class="form-group col-date-from col-12 col-sm-6 col-md-4 slash">
                <label class="labelFeature" for="check-out">Check out</label>
                <input type="text" class="inputFeature input-arrow readonly js-datepicker" id="check-out" name="check-out" placeholder="Select..." required="required" autocomplete="off">
            </div>
            <div class="form-group col-12 col-md-4 dropdown">
                <div class="closeDropdown" id="dropdownPersonsAction" data-toggle="dropdown" data-display="static">
                    <label class="labelFeature" for="person-total">Guests</label>
                    <input type="text" class="inputFeature input-arrow readonly" id="person-total" name="person" placeholder="Select..." required="required" autocomplete="off">
                </div>
                <!-- Dropdown person -->
                <div class="dropdown-menu dropdown-menu-lg-left dropdown-menu-right" id="dropdownPersons" aria-labelledby="dropdownPersonsAction">
                    <div class="row">
                        <div class="form-group col-6 col__left">
                            <label class="label" for="person-adult">Adults</label>
                            <div class="js-quantity">
                                <span class="qty-minus icon-minus"></span>
                                <input type="number" class="inputText js-quantity-input" id="person-adult" name="person-adalt" value="0" min="1" max="8" readonly="readonly">
                                <span class="qty-plus icon-plus"></span>
                            </div>	
                        </div>
                        <div class="form-group col-6 col__right">
                            <label class="label" for="person-kids">Children</label>
                            <div class="js-quantity">
                                <span class="qty-minus icon-minus"></span>
                                <input type="number" class="inputText js-quantity-input" id="person-kids" name="person-kids" value="0" min="0" max="8" readonly="readonly">
                                <span class="qty-plus icon-plus"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row row-footer">
                        <div class="col-6 col__left">
                            <button type="button" class="btn btn__small btn__second btn-reset-persons w-100">Close</button>
                        </div>
                        <div class="col-6 col__right">
                            <button type="button" class="btn btn__small btn-close-dropdown w-100">Apply</button>
                        </div>
                    </div>	
                </div>
                <!-- /Dropdown person -->
            </div>
        </div>
        <button type="submit" class="btn-booking" style="font-family: 'Playfair Display', serif">Search...</button>
    </form>
</div>	
<!-- /Booking -->