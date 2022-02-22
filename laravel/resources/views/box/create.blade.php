@extends('layouts.create-box')
@section('title', 'Boxeon | Create Box')
@section('content')

    <div id='module'>
        <form id='create-box' name='basics' action='/box' method='post'>
            @csrf
            @method('POST')

            <fieldset>
                <legend class='primary-color'>Capital</legend>
                <h3>Do you want to sell pre-orders?</h3>
                <div class='div-form-field-explain'>

                    <p>You may have fans pre-order your boxes for you to secure
                        the starting capital to launch your box. Pre-order sales can last one month.
                        Pre-orders must be shipped within a month after pre-order sales have ended.</p>
                </div>
                <label>
                    <select id='pre-order' required name='pre_order'>
                        <option value='0'>No</option>
                        <option value='1'>Yes</option>
                    </select>
                </label>
                <div id='special-offer' class='float-left'>
                    <h3>Do you want to offer a 30-minute chat by phone for the
                        first ten fans who pre-order? </h3>
                    <div class='div-form-field-explain'>
                        <p>Pre-orders work best with a special offer.
                            We recommend offering a 30-minute chat by phone for the first ten buyers who pre-order.
                        </p>
                    </div>

                    <select class='special-offer' disabled required name='special_offer'>
                        <option value='1'>Yes</option>
                        <option value='0'>No</option>
                    </select>
            </fieldset>
            <fieldset>
                <legend class='primary-color'>Supply</legend>
                <h3>How many boxes will you make available for sale monthly?</h3>
                <div class='div-form-field-explain'>
                    <p>Change this at any time in Accounts.</p>
                </div>
                <input type='number' required value='' name='box_supply' placeHolder='1'>
            </fieldset>
            <fieldset>
                <legend class='primary-color'>Price</legend>
                <h3>What's the price per box in US dollars?</h3>
                <div class='div-form-field-explain'>
                    <p>We recommend going with the average price of a subscription box, which is USD 35, but you may enter
                        any price.</p>
                    <p>Change this at any time in Accounts.</p>
                </div>
                <input type='number' required value='' name='price' placeholder='1'>
            </fieldset>
            <fieldset>
                <legend class='primary-color'>Branding</legend>
                <h3>Check availability of the URL you want for your page.</h3>
                <label id='grid-custom-url'>
                    <p class='one-em-font'>https://boxeon.com/</p>
                    <input id='box-url' type='text' required autocomplete='off' value='' placeHolder='YourCustomURL' name='box_url'>
                    <input id='check-url' class='button' type='button' value='Check'>
                </label>
            </fieldset>
            <fieldset>
                <legend class='primary-color'>Branding</legend>
                <h3>Provide a page name.</h3>
                
                    <input type='text' required autocomplete='off' value='' placeHolder='Exame: your YouTube channel name' name='page_name'>
                
            </fieldset>
            <fieldset>
                <legend class='primary-color'>Shipping</legend>
                <h3>Do you want to offer free shipping?</h3>
                <div class='div-form-field-explain'>
                    <p>Sell more boxes by offering buyers free
                        shipping. Don't worry - you may save up to 90% on shipping costs by ordering shipping labels on the
                        Ship Boxes page.</p>
                    <p>Change this at any time in Accounts.</p>
                </div>
                <label>
                    <select required name='shipping_cost'>
                        <option value='1'>Yes</option>
                        <option value='0'>No</option>
                    </select>
                </label>
            </fieldset>
            <fieldset>
                <legend class='primary-color'>Partnership</legend>
                <label class='float-left'>Are you in our partner program?</label>
                <label class='float-left'>Yes
                    <input type='radio' id='disable' value='1' checked name='curation' />
                </label>
                <label class='float-left'>
                    No
                    <input type='radio' id='show-disabled' value='0' name='curation' />
                </label>
            </fieldset>


            <fieldset id='curation1'>
                <legend class='primary-color'>Box weight</legend>
                <h3>What's the weight of your box?</h3>
                <div class='div-form-field-explain'>

                    <p>Our research indicates that most people can ship 4 pounds or under at a reasonable enough rate to
                        make a subscription box priced at USD 30 (plus shipping) a sustainable box. If you're unsure of the
                        weight, you may input the maximum weight you will have and later edit this in Account.</p>
                </div>
                <input class='optional' type='number' disabled required value='' placeholder='Weight of box in pounds'
                    name='box_weight' min='1' max='1000000'>
            </fieldset>
            <fieldset class='hiden'>
                <legend class='primary-color'>Box dimensions</legend>
                <h3>What is the length, with, and height of your box?</h3>
                <div class='div-form-field-explain'>
                    <p>Shipping carriers need this info to calculate the cost of shipping your boxes. The most common subscription
                        box sizes are 8" x 8" x 4", 10" x 6" x 4", and 9" x 6" x 3". These boxes can be sourced from most
                        shipping suppliers since they are so common and are affordable to ship.</p>
                    <p>Change this at any time in Accounts.</p>
                </div>

                <input class='optional' type='number' disabled required value='' placeholder='Length of box in inches'
                    name='box_length' min='1' max='1000000'>
                <input class='optional' type='number' disabled required value='' placeholder='Width of box in inches'
                    name='box_width' min='1' max='1000000'>
                <input class='optional' type='number' disabled required value='' placeholder='Height of box in inches'
                    name='box_height' min='1' max='1000000'>
            </fieldset>

            <fieldset class='hiden'>
                <legend class='primary-color'>Products</legend>
                <h3>What's inside your box?</h3>
                <input class='optional' type='number' disabled required name='num_products'
                    placeholder='Approximate number of products per box' min='1' max='25'>
                <select class='optional' disabled required name='prodname'>
                    <option value=''>Choose a category that best fits your box</option>
                    <option value='ACCESSORIES'>Accessories</option>
                    <option value='AGRICULTURAL_COOPERATIVE_FOR_MAIL_ORDER'>Agricultural</option>
                    <option value='ANTIQUES'>Antiques</option>
                    <option value='ART_AND_CRAFT_SUPPLIES'>Art &#38;Craft Supplies</option>
                    <option value='ARTIFACTS_GRAVE_RELATED_AND_NATIVE_AMERICAN_CRAFTS'>Artifacts</option>
                    <option value='ARTS_AND_CRAFTS'>Arts and crafts</option>
                    <option value='ARTS_CRAFTS_AND_COLLECTIBLES'>Arts, crafts, and collectibles</option>
                    <option value='AUDIO_BOOKS'>Audio books</option>
                    <option value='AUTOMOTIVE'>Automotive</option>
                    <option value='AVIATION'>Aviation</option>
                    <option value='BABIES_CLOTHING_AND_SUPPLIES'>Babies Clothing &#38;Supplies</option>
                    <option value='BARBIES'>Barbies</option>
                    <option value='BATH_AND_BODY'>Bath and body</option>
                    <option value='BEAN_BABIES'>Bean Babies</option>
                    <option value='BEAUTY'>Beauty</option>
                    <option value='BEAUTY_AND_FRAGRANCES'>Beauty and fragrances</option>
                    <option value='BED_AND_BATH'>Bed &#38;Bath</option>
                    <option value='BOOKS'>Books</option>
                    <option value='BOOKS_AND_MAGAZINES'>Books and magazines</option>
                    <option value='BOOKS_MANUSCRIPTS'>Books, Manuscripts</option>
                    <option value='BOOKS_PERIODICALS_AND_NEWSPAPERS'>Books, Periodicals And Newspapers</option>
                    <option value='CAMERA_AND_PHOTOGRAPHIC_SUPPLIES'>Camera and photographic supplies</option>
                    <option value='CAMERAS'>Cameras</option>
                    <option value='CAMERAS_AND_PHOTOGRAPHY'>Cameras &#38;Photography</option>
                    <option value='CAMPING_AND_OUTDOORS'>Camping and outdoors</option>
                    <option value='CAMPING_AND_SURVIVAL'>Camping &#38;Survival</option>
                    <option value='CATERING_SERVICES'>Catering services</option>
                    <option value='CHILDREN_BOOKS'>Children Books</option>
                    <option value='CIGAR_STORES_AND_STANDS'>Cigars</option>
                    <option value='CLOTHING'>Clothing</option>
                    <option value='CLOTHING_ACCESSORIES_AND_SHOES'>Clothing, accessories, and shoes</option>
                    <option value='COFFEE_AND_TEA'>Coffee and tea</option>
                    <option value='COLLECTIBLES'>Collectibles</option>
                    <option value='COMPUTER_HARDWARE_AND_SOFTWARE'>Computer Hardware &#38;Software</option>
                    <option value='COSMETIC_STORES'>Cosmetics</option>
                    </option>
                    <option value='COUNTERFEIT_CURRENCY_AND_STAMPS'>Counterfeit Currency and Stamps</option>
                    <option value='COUNTERFEIT_ITEMS'>Counterfeit Items</option>
                    <option value='CULTURE_AND_RELIGION'>Culture &#38;Religion</option>
                    <option value='DAIRY_PRODUCTS_STORES'>Dairy Products</option>
                    <option value='DECORATIVE'>Decorative</option>
                    <option value='DENTAL'>Dental</option>
                    <option value='DEVICES'>Devices</option>
                    <option value='DIECAST_TOYS_VEHICLES'>Diecast, Toy Vehicles</option>
                    <option value='DIGITAL_GAMES'>Digital games</option>
                    <option value='DIGITAL_MEDIA_BOOKS_MOVIES_MUSIC'>Digital media,books,movies,music</option>
                    <option value='DRAPERY_WINDOW_COVERING_AND_UPHOLSTERY'>Drapery, window covering, and upholstery</option>
                    <option value='EDUCATIONAL_AND_TEXTBOOKS'>Educational and textbooks</option>
                    <option value='ELECTRIC_RAZOR_STORES'>Electric Razor Stores</option>
                    <option value='ELECTRICAL_AND_SMALL_APPLIANCE_REPAIR'>Electrical and small appliance repair</option>
                    <option value='ENTERTAINMENT_AND_MEDIA'>Entertainment and media</option>
                    <option value='FABRICS_AND_SEWING'>Fabrics &#38;Sewing</option>
                    <option value='FASHION_JEWELRY'>Fashion jewelry</option>
                    <option value='FAST_FOOD_RESTAURANTS'>Fast Food</option>
                    <option value='FICTION_AND_NONFICTION'>Fiction and nonfiction</option>
                    <option value='FISHING'>Fishing</option>
                    <option value='FLORISTS'>Florists</option>
                    <option value='FLOWERS'>Flowers</option>
                    <option value='FOOD_DRINK_AND_NUTRITION'>Food, Drink &#38;Nutrition</option>
                    <option value='FOOD_PRODUCTS'>Food Products</option>
                    <option value='FRAGRANCES_AND_PERFUMES'>Fragrances and perfumes</option>
                    <option value='GAME_SOFTWARE'>Game Software</option>
                    <option value='GAMES'>Games</option>
                    <option value='GARDEN_SUPPLIES'>Garden supplies</option>
                    <option value='GENERAL'>General</option>
                    <option value='GENERAL_SOFTWARE'>General - Software</option>
                    <option value='GIFTS_AND_FLOWERS'>Gifts and flowers</option>
                    <option value='GLASSWARE_CRYSTAL_STORES'>Glassware, Crystals</option>
                    <option value='GRAPHIC_AND_COMMERCIAL_DESIGN'>Graphic &#38;Commercial Design</option>
                    <option value='GREETING_CARDS'>Greeting Cards</option>
                    <option value='GROCERY_STORES_AND_SUPERMARKETS'>Grocery Stores &#38;Supermarkets</option>
                    <option value='HARDWARE_AND_TOOLS'>Hardware &#38;Tools</option>
                    <option value='HEALTH_AND_BEAUTY_SPAS'>Health and beauty spas</option>
                    <option value='HEALTH_AND_NUTRITION'>Health &#38;Nutrition</option>
                    <option value='HEALTH_AND_PERSONAL_CARE'>Health and personal care</option>
                    <option value='HOBBIES_TOYS_AND_GAMES'>Hobbies, Toys &#38;Games</option>
                    <option value='HOME_AND_GARDEN'>Home and garden</option>
                    <option value='HOME_AUDIO'>Home Audio</option>
                    <option value='HOME_DECOR'>Home decor</option>
                    <option value='HOME_ELECTRONICS'>Home Electronics</option>
                    <option value='HOUSEWARES'>Housewares</option>
                    <option value='HUMOROUS_GIFTS_AND_NOVELTIES'>Humorous Gifts &#38;Novelties</option>
                    <option value='HUNTING'>Hunting</option>
                    <option value='MAKEUP_AND_COSMETICS'>Makeup and cosmetics</option>
                    <option value='MEMORABILIA'>Memorabilia</option>
                    <option value='MEN_AND_BOY_CLOTHING_AND_ACCESSORY_STORES'>Men's And Boy's Clothing And Accessory
                    </option>
                    <option value='MEN_CLOTHING'>Men's Clothing</option>
                    <option value='MERCHANDISE'>Merchandise</option>
                    <option value='METAPHYSICAL'>Metaphysical</option>
                    <option value='MILITARIA'>Militaria</option>
                    <option value='MILITARY_AND_CIVIL_SERVICE_UNIFORMS'>Military and civil service uniforms</option>
                    <option value='MISC'>Misc'>Misc. General Merchandise</option>
                    <option value='MODEL_KITS'>Model Kits</option>
                    <option value='MOTION_PICTURE_THEATERS'>Motion Picture Theaters</option>
                    <option value='MOTOR_HOMES_DEALERS'>Motor Homes Dealers</option>
                    <option value='MOTOR_VEHICLE_SUPPLIES_AND_NEW_PARTS'>Motor Vehicle Supplies and New Parts</option>
                    <option value='MOTORCYCLE_DEALERS'>Motorcycle Dealers</option>
                    <option value='MOTORCYCLES'>Motorcycles</option>
                    <option value='MOVIE'>Movie</option>
                    <option value='MOVIE_TICKETS'>Movie tickets</option>
                    <option value='MOVING_AND_STORAGE'>Moving and storage</option>
                    <option value='MUSIC_CDS_CASSETTES_AND_ALBUMS'>Music - CDs, cassettes and albums</option>
                    <option value='MUSIC_STORE_INSTRUMENTS_AND_SHEET_MUSIC'>Music store - instruments and sheet music
                    </option>
                    <option value='NETWORKING'>Networking</option>
                    <option value='NEW_AGE'>New Age</option>
                    <option value='NEW_PARTS_AND_SUPPLIES_MOTOR_VEHICLE'>New parts and supplies - motor vehicle</option>
                    <option value='NEWS_DEALERS_AND_NEWSTANDS'>News Dealers and Newstands</option>
                    <option value='NON_DURABLE_GOODS'>Non-durable goods</option>
                    <option value='NON_FICTION'>Non-Fiction</option>
                    <option value='NON_PROFIT_POLITICAL_AND_RELIGION'>Non-Profit, Political &#38;Religion</option>
                    <option value='NONPROFIT'>Nonprofit</option>
                    <option value='NOVELTIES'>Novelties</option>
                    <option value='OFFICE_SUPPLIES_AND_EQUIPMENT'>Office Supplies and Equipment</option>
                    <option value='ONLINE_DATING'>Online Dating</option>
                    <option value='ONLINE_GAMING'>Online gaming</option>
                    <option value='ONLINE_GAMING_CURRENCY'>Online gaming currency</option>
                    <option value='ONLINE_SERVICES'>Online services</option>
                    <option value='OTHER'>Other</option>
                    <option value='PACKAGE_TOUR_OPERATORS'>Package Tour Operators</option>
                    <option value='PAINTBALL'>Paintball</option>
                    <option value='PAINTS_VARNISHES_AND_SUPPLIES'>Paints, Varnishes, and Supplies</option>
                    <option value='PARTS_AND_ACCESSORIES'>Parts and accessories</option>
                    <option value='PAWN_SHOPS'>Pawn Shops</option>
                    <option value='PERIPHERALS'>Peripherals</option>
                    <option value='PERSONALIZED_GIFTS'>Personalized Gifts</option>
                    <option value='PET_SHOPS_PET_FOOD_AND_SUPPLIES'>Pet shops, pet food, and supplies</option>
                    <option value='PETS_AND_ANIMALS'>Pets and animals</option>
                    <option value='PHOTOGRAPHIC_STUDIOS_PORTRAITS'>Photographic studios - portraits</option>
                    <option value='PHOTOGRAPHY'>Photography</option>
                    <option value='PHYSICAL_GOOD'>Physical Good</option>
                    <option value='PIECE_GOODS_NOTIONS_AND_OTHER_DRY_GOODS'>Piece Goods Notions and Other Dry Goods</option>
                    <option value='PLANTS_AND_SEEDS'>Plants and Seeds</option>
                    <option value='POLICE_RELATED_ITEMS'>Police-Related Items</option>
                    <option value='POLITICAL_ORGANIZATIONS'>Politcal Organizations</option>
                    <option value='POSTAL_SERVICES_GOVERNMENT_ONLY'>Postal Services - Government Only</option>
                    <option value='POSTERS'>Posters</option>
                    <option value='RELIGION_AND_SPIRITUALITY_FOR_PROFIT'>Religion and spirituality for profit</option>
                    <option value='RELIGIOUS'>Religious</option>
                    <option value='RETAIL'>Retail</option>
                    <option value='RETAIL_FINE_JEWELRY_AND_WATCHES'>Retail - fine jewelry and watches</option>
                    <option value='SCRAPBOOKING'>Scrapbooking</option>
                    <option value='SCULPTURES'>Sculptures</option>
                    <option value='SECURITY_AND_SURVEILLANCE'>Security and surveillance</option>
                    <option value='SECURITY_AND_SURVEILLANCE_EQUIPMENT'>Security and surveillance equipment</option>
                    <option value='SHIPPING_AND_PACKING'>Shipping &#38;Packaging</option>
                    <option value='SHOE_REPAIR_HAT_CLEANING'>Shoe Repair/Hat Cleaning</option>
                    <option value='SHOE_STORES'>Shoe Stores</option>
                    <option value='SHOES'>Shoes</option>
                    <option value='SOFTWARE'>Software</option>
                    <option value='SPORT_GAMES_AND_TOYS'>Sport games and toys</option>
                    <option value='SPORTING_GOODS'>Sporting Goods</option>
                    <option value='SPORTS_AND_OUTDOORS'>Sports and outdoors</option>
                    <option value='SPORTS_AND_RECREATION'>Sports &#38;Recreation</option>
                    <option value='STAMP_AND_COIN'>Stamp and coin</option>
                    <option value='STORED_VALUE_CARDS'>Stored Value Cards</option>
                    <option value='SUPPLIES'>Supplies</option>
                    <option value='SUPPLIES_AND_TOYS'>Supplies &#38;Toys</option>
                    <option value='SURVEILLANCE_EQUIPMENT'>Surveillance Equipment</option>
                    <option value='SWIMMING_POOLS_AND_SPAS'>Swimming Pools &#38;Spas</option>
                    <option value='TELEPHONE_EQUIPMENT'>Telephone Equipment</option>
                    <option value='TOOLS_AND_EQUIPMENT'>Tools and equipment</option>
                    <option value='TOYS_AND_GAMES'>Toys and games</option>
                    <option value='TYPESETTING_PLATE_MAKING_AND_RELATED_SERVICES'>Typesetting, Plate Making, and Related
                    </option>
                    <option value='USED_MERCHANDISE_AND_SECONDHAND_STORES'>Used Merchandise And Secondhand</option>
                    <option value='VINTAGE_AND_COLLECTIBLES'>Vintage and collectibles</option>
                    <option value='VITAMINS_AND_SUPPLEMENTS'>Vitamins &#38;Supplements</option>
                    <option value='WILDLIFE_PRODUCTS'>Wildlife Products</option>
                    <option value='WOMEN_ACCESSORY_SPECIALITY'>Women's Accessory/Speciality</option>
                </select>
            </fieldset><fieldset class='hiden'>
                <legend class='primary-color'>Theme</legend>
                <h3>What's the theme of your box?</h3>
                <div class='div-form-field-explain'>
                    <p>Tells us in 127 max characters.</p>
                </div>
                <textarea class='optional' disabled required maxlength='127' name='proddesc' rows='2' cols='40'
                    placeHolder='Example: Interesting finds from my African travels'></textarea>
            </fieldset>
            <fieldset id='curation2'>
                <legend class='primary-color'>Shipping address</legend>
                <h3>What address will you ship from?</h3>
                <div class='div-form-field-explain'>
                    <p>We will use this info to calculate the cost of shipping to your buyers and
                        to generate the postage /
                        shipping labels you will need to ship your boxes. If you don't offer free shipping, our algorithm
                        will use your shipping address to calculate the cost of shipping for your buyers during the checkout
                        process.</p>
                    <p>Change this at any time in Accounts.</p>
                </div>
                <input name='address_line_1' type='text' class='optional' disabled required value=''
                    placeHolder='Street address' />
                <input name='address_line_2' type='text' class='optional' disabled value=''
                    placeHolder='Address line 2 (optional)' />
                <input name='admin_area_2' type='text' class='optional' disabled required value='' placeHolder='City' />
                <input name='admin_area_1' type='text' class='optional' disabled required value='' placeHolder='State' />
                <select disabled required name='country_code' class='optional form-control' id='country'>
                    <option value='' invalid>Select your country </option>
                    <optgroup id='country-optgroup-Africa' label='Africa'>
                        <option value='DZ' label='Algeria'>Algeria</option>
                        <option value='AO' label='Angola'>Angola</option>
                        <option value='BJ' label='Benin'>Benin</option>
                        <option value='BW' label='Botswana'>Botswana</option>
                        <option value='BF' label='Burkina Faso'>Burkina Faso</option>
                        <option value='BI' label='Burundi'>Burundi</option>
                        <option value='CM' label='Cameroon'>Cameroon</option>
                        <option value='CV' label='Cape Verde'>Cape Verde</option>
                        <option value='CF' label='Central African Republic'>Central African Republic</option>
                        <option value='TD' label='Chad'>Chad</option>
                        <option value='KM' label='Comoros'>Comoros</option>
                        <option value='CG' label='Congo - Brazzaville'>Congo - Brazzaville</option>
                        <option value='CD' label='Congo - Kinshasa'>Congo - Kinshasa</option>
                        <option value='CI' label='Côte d’Ivoire'>Côte d’Ivoire</option>
                        <option value='DJ' label='Djibouti'>Djibouti</option>
                        <option value='EG' label='Egypt'>Egypt</option>
                        <option value='GQ' label='Equatorial Guinea'>Equatorial Guinea</option>
                        <option value='ER' label='Eritrea'>Eritrea</option>
                        <option value='ET' label='Ethiopia'>Ethiopia</option>
                        <option value='GA' label='Gabon'>Gabon</option>
                        <option value='GM' label='Gambia'>Gambia</option>
                        <option value='GH' label='Ghana'>Ghana</option>
                        <option value='GN' label='Guinea'>Guinea</option>
                        <option value='GW' label='Guinea-Bissau'>Guinea-Bissau</option>
                        <option value='KE' label='Kenya'>Kenya</option>
                        <option value='LS' label='Lesotho'>Lesotho</option>
                        <option value='LR' label='Liberia'>Liberia</option>
                        <option value='LY' label='Libya'>Libya</option>
                        <option value='MG' label='Madagascar'>Madagascar</option>
                        <option value='MW' label='Malawi'>Malawi</option>
                        <option value='ML' label='Mali'>Mali</option>
                        <option value='MR' label='Mauritania'>Mauritania</option>
                        <option value='MU' label='Mauritius'>Mauritius</option>
                        <option value='YT' label='Mayotte'>Mayotte</option>
                        <option value='MA' label='Morocco'>Morocco</option>
                        <option value='MZ' label='Mozambique'>Mozambique</option>
                        <option value='NA' label='Namibia'>Namibia</option>
                        <option value='NE' label='Niger'>Niger</option>
                        <option value='NG' label='Nigeria'>Nigeria</option>
                        <option value='RW' label='Rwanda'>Rwanda</option>
                        <option value='RE' label='Réunion'>Réunion</option>
                        <option value='SH' label='Saint Helena'>Saint Helena</option>
                        <option value='SN' label='Senegal'>Senegal</option>
                        <option value='SC' label='Seychelles'>Seychelles</option>
                        <option value='SL' label='Sierra Leone'>Sierra Leone</option>
                        <option value='SO' label='Somalia'>Somalia</option>
                        <option value='ZA' label='South Africa'>South Africa</option>
                        <option value='SD' label='Sudan'>Sudan</option>
                        <option value='SZ' label='Swaziland'>Swaziland</option>
                        <option value='ST' label='São Tomé and Príncipe'>São Tomé and Príncipe</option>
                        <option value='TZ' label='Tanzania'>Tanzania</option>
                        <option value='TG' label='Togo'>Togo</option>
                        <option value='TN' label='Tunisia'>Tunisia</option>
                        <option value='UG' label='Uganda'>Uganda</option>
                        <option value='EH' label='Western Sahara'>Western Sahara</option>
                        <option value='ZM' label='Zambia'>Zambia</option>
                        <option value='ZW' label='Zimbabwe'>Zimbabwe</option>
                    </optgroup>
                    <optgroup id='country-optgroup-Americas' label='Americas'>
                        <option value='AI' label='Anguilla'>Anguilla</option>
                        <option value='AG' label='Antigua and Barbuda'>Antigua and Barbuda</option>
                        <option value='AR' label='Argentina'>Argentina</option>
                        <option value='AW' label='Aruba'>Aruba</option>
                        <option value='BS' label='Bahamas'>Bahamas</option>
                        <option value='BB' label='Barbados'>Barbados</option>
                        <option value='BZ' label='Belize'>Belize</option>
                        <option value='BM' label='Bermuda'>Bermuda</option>
                        <option value='BO' label='Bolivia'>Bolivia</option>
                        <option value='BR' label='Brazil'>Brazil</option>
                        <option value='VG' label='British Virgin Islands'>British Virgin Islands</option>
                        <option value='CA' label='Canada'>Canada</option>
                        <option value='KY' label='Cayman Islands'>Cayman Islands</option>
                        <option value='CL' label='Chile'>Chile</option>
                        <option value='CO' label='Colombia'>Colombia</option>
                        <option value='CR' label='Costa Rica'>Costa Rica</option>
                        <option value='CU' label='Cuba'>Cuba</option>
                        <option value='DM' label='Dominica'>Dominica</option>
                        <option value='DO' label='Dominican Republic'>Dominican Republic</option>
                        <option value='EC' label='Ecuador'>Ecuador</option>
                        <option value='SV' label='El Salvador'>El Salvador</option>
                        <option value='FK' label='Falkland Islands'>Falkland Islands</option>
                        <option value='GF' label='French Guiana'>French Guiana</option>
                        <option value='GL' label='Greenland'>Greenland</option>
                        <option value='GD' label='Grenada'>Grenada</option>
                        <option value='GP' label='Guadeloupe'>Guadeloupe</option>
                        <option value='GT' label='Guatemala'>Guatemala</option>
                        <option value='GY' label='Guyana'>Guyana</option>
                        <option value='HT' label='Haiti'>Haiti</option>
                        <option value='HN' label='Honduras'>Honduras</option>
                        <option value='JM' label='Jamaica'>Jamaica</option>
                        <option value='MQ' label='Martinique'>Martinique</option>
                        <option value='MX' label='Mexico'>Mexico</option>
                        <option value='MS' label='Montserrat'>Montserrat</option>
                        <option value='AN' label='Netherlands Antilles'>Netherlands Antilles</option>
                        <option value='NI' label='Nicaragua'>Nicaragua</option>
                        <option value='PA' label='Panama'>Panama</option>
                        <option value='PY' label='Paraguay'>Paraguay</option>
                        <option value='PE' label='Peru'>Peru</option>
                        <option value='PR' label='Puerto Rico'>Puerto Rico</option>
                        <option value='BL' label='Saint Barthélemy'>Saint Barthélemy</option>
                        <option value='KN' label='Saint Kitts and Nevis'>Saint Kitts and Nevis</option>
                        <option value='LC' label='Saint Lucia'>Saint Lucia</option>
                        <option value='MF' label='Saint Martin'>Saint Martin</option>
                        <option value='PM' label='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option>
                        <option value='VC' label='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines
                        </option>
                        <option value='SR' label='Suriname'>Suriname</option>
                        <option value='TT' label='Trinidad and Tobago'>Trinidad and Tobago</option>
                        <option value='TC' label='Turks and Caicos Islands'>Turks and Caicos Islands</option>
                        <option value='VI' label='U.S. Virgin Islands'>U.S. Virgin Islands</option>
                        <option value='US' label='United States'>United States</option>
                        <option value='UY' label='Uruguay'>Uruguay</option>
                        <option value='VE' label='Venezuela'>Venezuela</option>
                    </optgroup>
                    <optgroup id='country-optgroup-Asia' label='Asia'>
                        <option value='AF' label='Afghanistan'>Afghanistan</option>
                        <option value='AM' label='Armenia'>Armenia</option>
                        <option value='AZ' label='Azerbaijan'>Azerbaijan</option>
                        <option value='BH' label='Bahrain'>Bahrain</option>
                        <option value='BD' label='Bangladesh'>Bangladesh</option>
                        <option value='BT' label='Bhutan'>Bhutan</option>
                        <option value='BN' label='Brunei'>Brunei</option>
                        <option value='KH' label='Cambodia'>Cambodia</option>
                        <option value='CN' label='China'>China</option>
                        <option value='CY' label='Cyprus'>Cyprus</option>
                        <option value='GE' label='Georgia'>Georgia</option>
                        <option value='HK' label='Hong Kong SAR China'>Hong Kong SAR China</option>
                        <option value='IN' label='India'>India</option>
                        <option value='ID' label='Indonesia'>Indonesia</option>
                        <option value='IR' label='Iran'>Iran</option>
                        <option value='IQ' label='Iraq'>Iraq</option>
                        <option value='IL' label='Israel'>Israel</option>
                        <option value='JP' label='Japan'>Japan</option>
                        <option value='JO' label='Jordan'>Jordan</option>
                        <option value='KZ' label='Kazakhstan'>Kazakhstan</option>
                        <option value='KW' label='Kuwait'>Kuwait</option>
                        <option value='KG' label='Kyrgyzstan'>Kyrgyzstan</option>
                        <option value='LA' label='Laos'>Laos</option>
                        <option value='LB' label='Lebanon'>Lebanon</option>
                        <option value='MO' label='Macau SAR China'>Macau SAR China</option>
                        <option value='MY' label='Malaysia'>Malaysia</option>
                        <option value='MV' label='Maldives'>Maldives</option>
                        <option value='MN' label='Mongolia'>Mongolia</option>
                        <option value='MM' label='Myanmar [Burma]'>Myanmar [Burma]</option>
                        <option value='NP' label='Nepal'>Nepal</option>
                        <option value='NT' label='Neutral Zone'>Neutral Zone</option>
                        <option value='KP' label='North Korea'>North Korea</option>
                        <option value='OM' label='Oman'>Oman</option>
                        <option value='PK' label='Pakistan'>Pakistan</option>
                        <option value='PS' label='Palestinian Territories'>Palestinian Territories</option>
                        <option value='YD' label='Peoples Democratic Republic of Yemen'>People's Democratic Republic of
                            Yemen</option>
                        <option value='PH' label='Philippines'>Philippines</option>
                        <option value='QA' label='Qatar'>Qatar</option>
                        <option value='SA' label='Saudi Arabia'>Saudi Arabia</option>
                        <option value='SG' label='Singapore'>Singapore</option>
                        <option value='KR' label='South Korea'>South Korea</option>
                        <option value='LK' label='Sri Lanka'>Sri Lanka</option>
                        <option value='SY' label='Syria'>Syria</option>
                        <option value='TW' label='Taiwan'>Taiwan</option>
                        <option value='TJ' label='Tajikistan'>Tajikistan</option>
                        <option value='TH' label='Thailand'>Thailand</option>
                        <option value='TL' label='Timor-Leste'>Timor-Leste</option>
                        <option value='TR' label='Turkey'>Turkey</option>
                        <option value='TM' label='Turkmenistan'>Turkmenistan</option>
                        <option value='AE' label='United Arab Emirates'>United Arab Emirates</option>
                        <option value='UZ' label='Uzbekistan'>Uzbekistan</option>
                        <option value='VN' label='Vietnam'>Vietnam</option>
                        <option value='YE' label='Yemen'>Yemen</option>
                    </optgroup>
                    <optgroup id='country-optgroup-Europe' label='Europe'>
                        <option value='AL' label='Albania'>Albania</option>
                        <option value='AD' label='Andorra'>Andorra</option>
                        <option value='AT' label='Austria'>Austria</option>
                        <option value='BY' label='Belarus'>Belarus</option>
                        <option value='BE' label='Belgium'>Belgium</option>
                        <option value='BA' label='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>
                        <option value='BG' label='Bulgaria'>Bulgaria</option>
                        <option value='HR' label='Croatia'>Croatia</option>
                        <option value='CY' label='Cyprus'>Cyprus</option>
                        <option value='CZ' label='Czech Republic'>Czech Republic</option>
                        <option value='DK' label='Denmark'>Denmark</option>
                        <option value='DD' label='East Germany'>East Germany</option>
                        <option value='EE' label='Estonia'>Estonia</option>
                        <option value='FO' label='Faroe Islands'>Faroe Islands</option>
                        <option value='FI' label='Finland'>Finland</option>
                        <option value='FR' label='France'>France</option>
                        <option value='DE' label='Germany'>Germany</option>
                        <option value='GI' label='Gibraltar'>Gibraltar</option>
                        <option value='GR' label='Greece'>Greece</option>
                        <option value='GG' label='Guernsey'>Guernsey</option>
                        <option value='HU' label='Hungary'>Hungary</option>
                        <option value='IS' label='Iceland'>Iceland</option>
                        <option value='IE' label='Ireland'>Ireland</option>
                        <option value='IM' label='Isle of Man'>Isle of Man</option>
                        <option value='IT' label='Italy'>Italy</option>
                        <option value='JE' label='Jersey'>Jersey</option>
                        <option value='LV' label='Latvia'>Latvia</option>
                        <option value='LI' label='Liechtenstein'>Liechtenstein</option>
                        <option value='LT' label='Lithuania'>Lithuania</option>
                        <option value='LU' label='Luxembourg'>Luxembourg</option>
                        <option value='MK' label='Macedonia'>Macedonia</option>
                        <option value='MT' label='Malta'>Malta</option>
                        <option value='FX' label='Metropolitan France'>Metropolitan France</option>
                        <option value='MD' label='Moldova'>Moldova</option>
                        <option value='MC' label='Monaco'>Monaco</option>
                        <option value='ME' label='Montenegro'>Montenegro</option>
                        <option value='NL' label='Netherlands'>Netherlands</option>
                        <option value='NO' label='Norway'>Norway</option>
                        <option value='PL' label='Poland'>Poland</option>
                        <option value='PT' label='Portugal'>Portugal</option>
                        <option value='RO' label='Romania'>Romania</option>
                        <option value='RU' label='Russia'>Russia</option>
                        <option value='SM' label='San Marino'>San Marino</option>
                        <option value='RS' label='Serbia'>Serbia</option>
                        <option value='CS' label='Serbia and Montenegro'>Serbia and Montenegro</option>
                        <option value='SK' label='Slovakia'>Slovakia</option>
                        <option value='SI' label='Slovenia'>Slovenia</option>
                        <option value='ES' label='Spain'>Spain</option>
                        <option value='SJ' label='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option>
                        <option value='SE' label='Sweden'>Sweden</option>
                        <option value='CH' label='Switzerland'>Switzerland</option>
                        <option value='UA' label='Ukraine'>Ukraine</option>
                        <option value='SU' label='Union of Soviet Socialist Republics'>Union of Soviet Socialist Republics
                        </option>
                        <option value='GB' label='United Kingdom'>United Kingdom</option>
                        <option value='VA' label='Vatican City'>Vatican City</option>
                        <option value='AX' label='Åland Islands'>Åland Islands</option>
                    </optgroup>
                    <optgroup id='country-optgroup-Oceania' label='Oceania'>
                        <option value='AS' label='American Samoa'>American Samoa</option>
                        <option value='AQ' label='Antarctica'>Antarctica</option>
                        <option value='AU' label='Australia'>Australia</option>
                        <option value='BV' label='Bouvet Island'>Bouvet Island</option>
                        <option value='IO' label='British Indian Ocean Territory'>British Indian Ocean Territory</option>
                        <option value='CX' label='Christmas Island'>Christmas Island</option>
                        <option value='CC' label='Cocos [Keeling] Islands'>Cocos [Keeling] Islands</option>
                        <option value='CK' label='Cook Islands'>Cook Islands</option>
                        <option value='FJ' label='Fiji'>Fiji</option>
                        <option value='PF' label='French Polynesia'>French Polynesia</option>
                        <option value='TF' label='French Southern Territories'>French Southern Territories</option>
                        <option value='GU' label='Guam'>Guam</option>
                        <option value='HM' label='Heard Island and McDonald Islands'>Heard Island and McDonald Islands
                        </option>
                        <option value='KI' label='Kiribati'>Kiribati</option>
                        <option value='MH' label='Marshall Islands'>Marshall Islands</option>
                        <option value='FM' label='Micronesia'>Micronesia</option>
                        <option value='NR' label='Nauru'>Nauru</option>
                        <option value='NC' label='New Caledonia'>New Caledonia</option>
                        <option value='NZ' label='New Zealand'>New Zealand</option>
                        <option value='NU' label='Niue'>Niue</option>
                        <option value='NF' label='Norfolk Island'>Norfolk Island</option>
                        <option value='MP' label='Northern Mariana Islands'>Northern Mariana Islands</option>
                        <option value='PW' label='Palau'>Palau</option>
                        <option value='PG' label='Papua New Guinea'>Papua New Guinea</option>
                        <option value='PN' label='Pitcairn Islands'>Pitcairn Islands</option>
                        <option value='WS' label='Samoa'>Samoa</option>
                        <option value='SB' label='Solomon Islands'>Solomon Islands</option>
                        <option value='GS' label='South Georgia and the South Sandwich Islands'>South Georgia and the South
                            Sandwich Islands</option>
                        <option value='TK' label='Tokelau'>Tokelau</option>
                        <option value='TO' label='Tonga'>Tonga</option>
                        <option value='TV' label='Tuvalu'>Tuvalu</option>
                        <option value='UM' label='U.S. Minor Outlying Islands'>U.S. Minor Outlying Islands</option>
                        <option value='VU' label='Vanuatu'>Vanuatu</option>
                        <option value='WF' label='Wallis and Futuna'>Wallis and Futuna</option>
                    </optgroup>
                </select>
                <input name='postal_code' type='text' class='optional' disabled required value=''
                    placeHolder='Postal code' />
            </fieldset>

            <input type='submit' value='Save' />

        </form>
    </div>

@endsection
