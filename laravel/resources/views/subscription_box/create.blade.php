@extends('layouts.create-box')

@section('content')


<?php

$box = DB::select('select box_weight from boxes where user_id= ?', [$user->id]); 

if(empty($box) || is_null($box[0]->box_weight)){

echo "<div id='module'>
    <form id='create-box' name='basics' action='/box' method='post'>";
?>
        @csrf
        @method('POST')

        <?php
        echo "<fieldset><legend class='primary-color'>Marketing</legend>
        <div class='alert float-left'>
        <p class='material-icons'>info</p><p>You can have fans pre-order your boxes for you to secure 
        the starting capital to launch your box. Pre-order sales can last one month. 
        Pre-orders must be shipped within a month after pre-order sales have ended.</p></div>
        <label>Do you want to sell pre-orders?
        <select id='pre-order' required name='pre_order'>
        <option value='0'>No</option>
        <option value='1'>Yes</option>
        </select> 
        </label>
        <div id='special-offer' class='alert float-left'>
        <p class='material-icons'>info</p><p>Pre-orders work best with a special offer.  
            We recommend offering a 30-minute chat by phone for the first ten fans who pre-order.
        </p></div>
        <label class='special-offer'>Do you want to offer a 30-minute chat by phone for the 
        first ten fans who pre-order?    </label>
        <select class='special-offer' disabled required name='special_offer'>
        <option value='1'>Yes</option>
        <option value='0'>No</option>
    </select>
    <label>How many boxes will you make available for sale monthly?</label>
        <input type='number' required value='' name='box_supply' placeHolder='60'>
        <label>What's the price per box in US dollars?</label>
        <input type='number' required value='' name='price' placeholder='30'>
        <label>Create a custum URL for your subscription box page.</label>
        <label id='grid-custom-url'><p class='one-em-font'>https://boxeon.com/</p>
        <input type='text' required value='' placeholder='Your custom URL' name='box_url'>
        </label>
        <div class='alert float-left'>
        <p class='material-icons'> info</p><p>Sell more boxes by offering buyers free 
            shipping, and keep shipping costs low by using <b>flat rate</b> shipping.</p></div>
        <label>Do you want to offer free shipping?
        <select required name='shipping_cost'>
        <option value='1'>Yes</option>
        <option value='0'>No</option>
        </select> 
        </label>      
       </fieldset>
        <fieldset><legend class='primary-color'>Support</legend>
        <label class='float-left'>Do you need help with product curation?</label>
        <label class='float-left'>Yes
        <input type='radio' id='disable' value='1' checked name='curation'/>
        </label>
        <label class='float-left'>
        No
         <input type='radio' id='show-disabled' value='0' name='curation'/>
        </label>
        </fieldset>
       <fieldset id='curation1'><legend class='primary-color'>Box description</legend>
       <label>We'll use this info to generate postage / shipping labels you will need to ship your boxes.</label>
        <input class='optional' type='number'  disabled required name='num_products' placeholder='Number of products in box' min='1' max='25'>
        <input class='optional' type='number' disabled required value='' placeholder='Weight of box in pounds' name='box_weight' min='1' max='1000000'>
        <input class='optional' type='number'  disabled required value='' placeholder='Length of box in inches' name='box_length' min='1' max='1000000'>
        <input class='optional' type='number'  disabled required value='' placeholder='Width of box in inches' name='box_width' min='1' max='1000000'>
        <input class='optional' type='number' disabled required value='' placeholder='Height of box in inches' name='box_height' min='1' max='1000000'>            <select class='optional' disabled required name='prodname'>
            <option value=''>Choose your product category</option>
            <option value='ACCESSORIES'>Accessories</option>
            <option value='AGRICULTURAL_COOPERATIVE_FOR_MAIL_ORDER'>Agricultural</option>
            <option value='ALCOHOLIC_BEVERAGES'>Alcoholic Beverages</option>
            <option value='ANTIQUES'>Antiques</option>
            <option value='ART_AND_CRAFT_SUPPLIES'>Art &#38;Craft Supplies</option>
            <option value='ARTIFACTS_GRAVE_RELATED_AND_NATIVE_AMERICAN_CRAFTS'>Artifacts</option>
            <option value='ARTS_AND_CRAFTS'>Arts and crafts</option>
            <option value='ARTS_CRAFTS_AND_COLLECTIBLES'>Arts, crafts, and collectibles</option>
            <option value='AUDIO_BOOKS'>Audio books</option>
            <option value='AUTOMOTIVE'>Automotive</option>
            <option value='AVIATION'>Aviation</option>
            <option value='BABIES_CLOTHING_AND_SUPPLIES'>Babies Clothing &#38;Supplies</option>
            <option value='BABY'>Baby</option>
            <option value='BARBIES'>Barbies</option>
            <option value='BATH_AND_BODY'>Bath and body</option>
            <option value='BATTERIES'>Batteries</option>
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

            <option value='CONSULTING_SERVICES'>Consulting services</option>
            <option value='COSMETIC_STORES'>Cosmetic Stores</option>
            <option value='COUNSELING_SERVICES_DEBT_MARRIAGE_PERSONAL'>Counseling Services--Debt,Marriage,Personal</option>
            <option value='COUNTERFEIT_CURRENCY_AND_STAMPS'>Counterfeit Currency and Stamps</option>
            <option value='COUNTERFEIT_ITEMS'>Counterfeit Items</option>
            <option value='CULTURE_AND_RELIGION'>Culture &#38;Religion</option>
            <option value='DAIRY_PRODUCTS_STORES'>Dairy Products Stores</option>
            <option value='DECORATIVE'>Decorative</option>
            <option value='DENTAL'>Dental</option>
            <option value='DEVICES'>Devices</option>
            <option value='DIECAST_TOYS_VEHICLES'>Diecast, Toys Vehicles</option>
            <option value='DIGITAL_GAMES'>Digital games</option>
            <option value='DIGITAL_MEDIA_BOOKS_MOVIES_MUSIC'>Digital media,books,movies,music</option>
            <option value='DIRECT_MARKETING'>Direct Marketing</option>
            <option value='DRAPERY_WINDOW_COVERING_AND_UPHOLSTERY'>Drapery, window covering, and upholstery</option>
            <option value='EDUCATIONAL_AND_TEXTBOOKS'>Educational and textbooks</option>
            <option value='ELECTRIC_RAZOR_STORES'>Electric Razor Stores</option>
            <option value='ELECTRICAL_AND_SMALL_APPLIANCE_REPAIR'>Electrical and small appliance repair</option>
            <option value='ELECTRONIC_CASH'>Electronic Cash</option>
            <option value='ENTERTAINMENT_AND_MEDIA'>Entertainment and media</option>

            <option value='EXTERMINATING_AND_DISINFECTING_SERVICES'>Exterminating and disinfecting services</option>
            <option value='FABRICS_AND_SEWING'>Fabrics &#38;Sewing</option>

            <option value='FASHION_JEWELRY'>Fashion jewelry</option>
            <option value='FAST_FOOD_RESTAURANTS'>Fast Food</option>
            <option value='FICTION_AND_NONFICTION'>Fiction and nonfiction</option>
            <option value='FINANCIAL_AND_INVESTMENT_ADVICE'>Financial and investment advice</option>

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
            <option value='GLASSWARE_CRYSTAL_STORES'>Glassware, Crystal Stores</option>
            <option value='GOVERNMENT'>Government</option>
            <option value='GOVERNMENT_valueS_AND_LICENSES'>Government values and Licenses</option>
            <option value='GOVERNMENT_LICENSED_ON_LINE_CASINOS_ON_LINE_GAMBLING'>Government Licensed On-Line Casinos - On-Line Gambling</option>
            <option value='GOVERNMENT_OWNED_LOTTERIES'>Government-Owned Lotteries</option>
            <option value='GOVERNMENT_SERVICES'>Government services</option>
            <option value='GRAPHIC_AND_COMMERCIAL_DESIGN'>Graphic &#38;Commercial Design</option>
            <option value='GREETING_CARDS'>Greeting Cards</option>
            <option value='GROCERY_STORES_AND_SUPERMARKETS'>Grocery Stores &#38;Supermarkets</option>
            <option value='HARDWARE_AND_TOOLS'>Hardware &#38;Tools</option>
            <option value='HARDWARE_EQUIPMENT_AND_SUPPLIES'>Hardware, Equipment, and Supplies</option>
            <option value='HAZARDOUS_RESTRICTED_AND_PERISHABLE_ITEMS'>Hazardous, Restricted and Perishable Items</option>
            <option value='HEALTH_AND_BEAUTY_SPAS'>Health and beauty spas</option>
            <option value='HEALTH_AND_NUTRITION'>Health &#38;Nutrition</option>
            <option value='HEALTH_AND_PERSONAL_CARE'>Health and personal care</option>
            <option value='HEARING_AvalueS_SALES_AND_SUPPLIES'>Hearing Avalues Sales and Supplies</option>
            <option value='HEATING_PLUMBING_AC'>Heating, Plumbing, AC</option>
            <option value='HIGH_RISK_MERCHANT'>High Risk Merchant</option>
            <option value='HIRING_SERVICES'>Hiring services</option>
            <option value='HOBBIES_TOYS_AND_GAMES'>Hobbies, Toys &#38;Games</option>
            <option value='HOME_AND_GARDEN'>Home and garden</option>
            <option value='HOME_AUDIO'>Home Audio</option>
            <option value='HOME_DECOR'>Home decor</option>
            <option value='HOME_ELECTRONICS'>Home Electronics</option>
            <option value='HOSPITALS'>Hospitals</option>
            <option value='HOTELS_MOTELS_INNS_RESORTS'>Hotels/Motels/Inns/Resorts</option>
            <option value='HOUSEWARES'>Housewares</option>
            <option value='HUMAN_PARTS_AND_REMAINS'>Human Parts and Remains</option>
            <option value='HUMOROUS_GIFTS_AND_NOVELTIES'>Humorous Gifts &#38;Novelties</option>
            <option value='HUNTING'>Hunting</option>
            <option value='valueS_LICENSES_AND_PASSPORTS'>values, licenses, and passports</option>
            <option value='ILLEGAL_DRUGS_AND_PARAPHERNALIA'>Illegal Drugs &#38;Paraphernalia</option>
            <option value='INDUSTRIAL'>Industrial</option>
            <option value='INDUSTRIAL_AND_MANUFACTURING_SUPPLIES'>Industrial and manufacturing supplies</option>
            <option value='INSURANCE_AUTO_AND_HOME'>Insurance - auto and home</option>
            <option value='INSURANCE_DIRECT'>Insurance - Direct</option>
            <option value='INSURANCE_LIFE_AND_ANNUITY'>Insurance - life and annuity</option>
            <option value='INSURANCE_SALES_UNDERWRITING'>Insurance Sales/Underwriting</option>
            <option value='INSURANCE_UNDERWRITING_PREMIUMS'>Insurance Underwriting, Premiums</option>
            <option value='INTERNET_AND_NETWORK_SERVICES'>Internet &#38;Network Services</option>
            <option value='INTRA_COMPANY_PURCHASES'>Intra-Company Purchases</option>
            <option value='LABORATORIES_DENTAL_MEDICAL'>Laboratories-Dental/Medical</option>
            <option value='LANDSCAPING'>Landscaping</option>
            <option value='LANDSCAPING_AND_HORTICULTURAL_SERVICES'>Landscaping And Horticultural Services</option>
            <option value='LAUNDRY_CLEANING_SERVICES'>Laundry, Cleaning Services</option>
            <option value='LEGAL'>Legal</option>
            <option value='LEGAL_SERVICES_AND_ATTORNEYS'>Legal services and attorneys</option>
            <option value='LOCAL_DELIVERY_SERVICE'>Local delivery service</option>
            <option value='LOCKSMITH'>Locksmith</option>
            <option value='LODGING_AND_ACCOMMODATIONS'>Lodging and accommodations</option>
            <option value='LOTTERY_AND_CONTESTS'>Lottery and contests</option>
            <option value='LUGGAGE_AND_LEATHER_GOODS'>Luggage and leather goods</option>
            <option value='LUMBER_AND_BUILDING_MATERIALS'>Lumber &#38;Building Materials</option>
            <option value='MAGAZINES'>Magazines</option>
            <option value='MAINTENANCE_AND_REPAIR_SERVICES'>Maintenance and repair services</option>
            <option value='MAKEUP_AND_COSMETICS'>Makeup and cosmetics</option>
            <option value='MANUAL_CASH_DISBURSEMENTS'>Manual Cash Disbursements</option>
            <option value='MASSAGE_PARLORS'>Massage Parlors</option>
            <option value='MEDICAL'>Medical</option>
            <option value='MEDICAL_AND_PHARMACEUTICAL'>Medical &#38;Pharmaceutical</option>
            <option value='MEDICAL_CARE'>Medical care</option>
            <option value='MEDICAL_EQUIPMENT_AND_SUPPLIES'>Medical equipment and supplies</option>
            <option value='MEDICAL_SERVICES'>Medical Services</option>
            <option value='MEETING_PLANNERS'>Meeting Planners</option>
            <option value='MEMBERSHIP_CLUBS_AND_ORGANIZATIONS'>Membership clubs and organizations</option>
            <option value='MEMBERSHIP_COUNTRY_CLUBS_GOLF'>Membership/Country Clubs/Golf</option>
            <option value='MEMORABILIA'>Memorabilia</option>
            <option value='MEN_AND_BOY_CLOTHING_AND_ACCESSORY_STORES'>Men's And Boy's Clothing And Accessory Stores</option>
            <option value='MEN_CLOTHING'>Men's Clothing</option>
            <option value='MERCHANDISE'>Merchandise</option>
            <option value='METAPHYSICAL'>Metaphysical</option>
            <option value='MILITARIA'>Militaria</option>
            <option value='MILITARY_AND_CIVIL_SERVICE_UNIFORMS'>Military and civil service uniforms</option>
            <option value='MISC'>Misc'>Misc. Automotive,Aircraft,And Farm Equipment Dealers</option>
            <option value='MISC'>Misc'>Misc. General Merchandise</option>
            <option value='MISCELLANEOUS_GENERAL_SERVICES'>Miscellaneous General Services</option>
            <option value='MISCELLANEOUS_REPAIR_SHOPS_AND_RELATED_SERVICES'>Miscellaneous Repair Shops And Related Services</option>
            <option value='MODEL_KITS'>Model Kits</option>
            <option value='MONEY_TRANSFER_MEMBER_FINANCIAL_INSTITUTION'>Money Transfer - Member Financial Institution</option>
            <option value='MONEY_TRANSFER_MERCHANT'>Money Transfer--Merchant</option>
            <option value='MOTION_PICTURE_THEATERS'>Motion Picture Theaters</option>
            <option value='MOTOR_FREIGHT_CARRIERS_AND_TRUCKING'>Motor Freight Carriers &#38;Trucking</option>
            <option value='MOTOR_HOME_AND_RECREATIONAL_VEHICLE_RENTAL'>Motor Home And Recreational Vehicle Rental</option>
            <option value='MOTOR_HOMES_DEALERS'>Motor Homes Dealers</option>
            <option value='MOTOR_VEHICLE_SUPPLIES_AND_NEW_PARTS'>Motor Vehicle Supplies and New Parts</option>
            <option value='MOTORCYCLE_DEALERS'>Motorcycle Dealers</option>
            <option value='MOTORCYCLES'>Motorcycles</option>
            <option value='MOVIE'>Movie</option>
            <option value='MOVIE_TICKETS'>Movie tickets</option>
            <option value='MOVING_AND_STORAGE'>Moving and storage</option>
            <option value='MULTI_LEVEL_MARKETING'>Multi-level marketing</option>
            <option value='MUSIC_CDS_CASSETTES_AND_ALBUMS'>Music - CDs, cassettes and albums</option>
            <option value='MUSIC_STORE_INSTRUMENTS_AND_SHEET_MUSIC'>Music store - instruments and sheet music</option>
            <option value='NETWORKING'>Networking</option>
            <option value='NEW_AGE'>New Age</option>
            <option value='NEW_PARTS_AND_SUPPLIES_MOTOR_VEHICLE'>New parts and supplies - motor vehicle</option>
            <option value='NEWS_DEALERS_AND_NEWSTANDS'>News Dealers and Newstands</option>
            <option value='NON_DURABLE_GOODS'>Non-durable goods</option>
            <option value='NON_FICTION'>Non-Fiction</option>
            <option value='NON_PROFIT_POLITICAL_AND_RELIGION'>Non-Profit, Political &#38;Religion</option>
            <option value='NONPROFIT'>Nonprofit</option>
            <option value='NOVELTIES'>Novelties</option>
            <option value='OEM_SOFTWARE'>Oem Software</option>
            <option value='OFFICE_SUPPLIES_AND_EQUIPMENT'>Office Supplies and Equipment</option>
            <option value='ONLINE_DATING'>Online Dating</option>
            <option value='ONLINE_GAMING'>Online gaming</option>
            <option value='ONLINE_GAMING_CURRENCY'>Online gaming currency</option>
            <option value='ONLINE_SERVICES'>online services</option>
            <option value='OOUTBOUND_TELEMARKETING_MERCH'>Ooutbound Telemarketing Merch</option>
            <option value='OPHTHALMOLOGISTS_OPTOMETRIST'>Ophthalmologists/Optometrist</option>
            <option value='OPTICIANS_AND_DISPENSING'>Opticians And Dispensing</option>
            <option value='ORTHOPEDIC_GOODS_PROSTHETICS'>Orthopedic Goods/Prosthetics</option>
            <option value='OSTEOPATHS'>Osteopaths</option>
            <option value='OTHER'>Other</option>
            <option value='PACKAGE_TOUR_OPERATORS'>Package Tour Operators</option>
            <option value='PAINTBALL'>Paintball</option>
            <option value='PAINTS_VARNISHES_AND_SUPPLIES'>Paints, Varnishes, and Supplies</option>
            <option value='PARKING_LOTS_AND_GARAGES'>Parking Lots &#38;Garages</option>
            <option value='PARTS_AND_ACCESSORIES'>Parts and accessories</option>
            <option value='PAWN_SHOPS'>Pawn Shops</option>
            <option value='PAYCHECK_LENDER_OR_CASH_ADVANCE'>Paycheck lender or cash advance</option>
            <option value='PERIPHERALS'>Peripherals</option>
            <option value='PERSONALIZED_GIFTS'>Personalized Gifts</option>
            <option value='PET_SHOPS_PET_FOOD_AND_SUPPLIES'>Pet shops, pet food, and supplies</option>
            <option value='PETROLEUM_AND_PETROLEUM_PRODUCTS'>Petroleum and Petroleum Products</option>
            <option value='PETS_AND_ANIMALS'>Pets and animals</option>
            <option value='PHOTOFINISHING_LABORATORIES_PHOTO_DEVELOPING'>Photofinishing Laboratories,Photo Developing</option>
            <option value='PHOTOGRAPHIC_STUDIOS_PORTRAITS'>Photographic studios - portraits</option>
            <option value='PHOTOGRAPHY'>Photography</option>
            <option value='PHYSICAL_GOOD'>Physical Good</option>
            <option value='PICTURE_VvalueEO_PRODUCTION'>Picture/Vvalueeo Production</option>
            <option value='PIECE_GOODS_NOTIONS_AND_OTHER_DRY_GOODS'>Piece Goods Notions and Other Dry Goods</option>
            <option value='PLANTS_AND_SEEDS'>Plants and Seeds</option>
            <option value='PLUMBING_AND_HEATING_EQUIPMENTS_AND_SUPPLIES'>Plumbing &#38;Heating Equipments &#38;Supplies</option>
            <option value='POLICE_RELATED_ITEMS'>Police-Related Items</option>
            <option value='POLITICAL_ORGANIZATIONS'>Politcal Organizations</option>
            <option value='POSTAL_SERVICES_GOVERNMENT_ONLY'>Postal Services - Government Only</option>
            <option value='POSTERS'>Posters</option>
            <option value='PREPAvalue_AND_STORED_VALUE_CARDS'>Prepavalue and stored value cards</option>
            <option value='PRESCRIPTION_DRUGS'>Prescription Drugs</option>
            <option value='PROMOTIONAL_ITEMS'>Promotional Items</option>
            <option value='PUBLIC_WAREHOUSING_AND_STORAGE'>Public Warehousing and Storage</option>
            <option value='PUBLISHING_AND_PRINTING'>Publishing and printing</option>
            <option value='PUBLISHING_SERVICES'>Publishing Services</option>
            <option value='RADAR_DECTORS'>Radar Dectors</option>
            <option value='RADIO_TELEVISION_AND_STEREO_REPAIR'>Radio, television, and stereo repair</option>
            <option value='REAL_ESTATE'>Real Estate</option>
            <option value='REAL_ESTATE_AGENT'>Real estate agent</option>
            <option value='REAL_ESTATE_AGENTS_AND_MANAGERS_RENTALS'>Real Estate Agents And Managers - Rentals</option>
            <option value='RELIGION_AND_SPIRITUALITY_FOR_PROFIT'>Religion and spirituality for profit</option>
            <option value='RELIGIOUS'>Religious</option>
            <option value='RELIGIOUS_ORGANIZATIONS'>Religious Organizations</option>
            <option value='REMITTANCE'>Remittance</option>
            <option value='RENTAL_PROPERTY_MANAGEMENT'>Rental property management</option>
            <option value='RESvalueENTIAL'>Resvalueential</option>
            <option value='RETAIL'>Retail</option>
            <option value='RETAIL_FINE_JEWELRY_AND_WATCHES'>Retail - fine jewelry and watches</option>
            <option value='REUPHOLSTERY_AND_FURNITURE_REPAIR'>Reupholstery and furniture repair</option>
            <option value='RINGS'>Rings</option>
            <option value='ROOFING_SvalueING_SHEET_METAL'>Roofing/Svalueing, Sheet Metal</option>
            <option value='RUGS_AND_CARPETS'>Rugs &#38;Carpets</option>
            <option value='SCHOOLS_AND_COLLEGES'>Schools and Colleges</option>
            <option value='SCIENCE_FICTION'>Science Fiction</option>
            <option value='SCRAPBOOKING'>Scrapbooking</option>
            <option value='SCULPTURES'>Sculptures</option>
            <option value='SECURITIES_BROKERS_AND_DEALERS'>Securities - Brokers And Dealers</option>
            <option value='SECURITY_AND_SURVEILLANCE'>Security and surveillance</option>
            <option value='SECURITY_AND_SURVEILLANCE_EQUIPMENT'>Security and surveillance equipment</option>
            <option value='SECURITY_BROKERS_AND_DEALERS'>Security brokers and dealers</option>
            <option value='SEMINARS'>Seminars</option>
            <option value='SERVICE_STATIONS'>Service Stations</option>
            <option value='SERVICES'>Services</option>
            <option value='SEWING_NEEDLEWORK_FABRIC_AND_PIECE_GOODS_STORES'>Sewing,Needlework,Fabric And Piece Goods Stores</option>
            <option value='SHIPPING_AND_PACKING'>Shipping &#38;Packaging</option>
            <option value='SHOE_REPAIR_HAT_CLEANING'>Shoe Repair/Hat Cleaning</option>
            <option value='SHOE_STORES'>Shoe Stores</option>
            <option value='SHOES'>Shoes</option>
            <option value='SNOWMOBILE_DEALERS'>Snowmobile Dealers</option>
            <option value='SOFTWARE'>Software</option>
            <option value='SPECIALTY_AND_MISC'>Specialty and misc'>Specialty and misc. food stores</option>
            <option value='SPECIALTY_CLEANING_POLISHING_AND_SANITATION_PREPARATIONS'>Specialty Cleaning, Polishing And Sanitation Preparations</option>
            <option value='SPECIALTY_OR_RARE_PETS'>Specialty or rare pets</option>
            <option value='SPORT_GAMES_AND_TOYS'>Sport games and toys</option>
            <option value='SPORTING_AND_RECREATIONAL_CAMPS'>Sporting And Recreational Camps</option>
            <option value='SPORTING_GOODS'>Sporting Goods</option>
            <option value='SPORTS_AND_OUTDOORS'>Sports and outdoors</option>
            <option value='SPORTS_AND_RECREATION'>Sports &#38;Recreation</option>
            <option value='STAMP_AND_COIN'>Stamp and coin</option>
            <option value='STATIONARY_PRINTING_AND_WRITING_PAPER'>Stationary, printing, and writing paper</option>
            <option value='STENOGRAPHIC_AND_SECRETARIAL_SUPPORT_SERVICES'>Stenographic and secretarial support services</option>
            <option value='STOCKS_BONDS_SECURITIES_AND_RELATED_CERTIFICATES'>Stocks, Bonds, Securities and Related Certificates</option>
            <option value='STORED_VALUE_CARDS'>Stored Value Cards</option>
            <option value='SUPPLIES'>Supplies</option>
            <option value='SUPPLIES_AND_TOYS'>Supplies &#38;Toys</option>
            <option value='SURVEILLANCE_EQUIPMENT'>Surveillance Equipment</option>
            <option value='SWIMMING_POOLS_AND_SPAS'>Swimming Pools &#38;Spas</option>
            <option value='SWIMMING_POOLS_SALES_SUPPLIES_SERVICES'>Swimming Pools-Sales,Supplies,Services</option>
            <option value='TAILORS_AND_ALTERATIONS'>Tailors and alterations</option>
            <option value='TAX_PAYMENTS'>Tax Payments</option>
            <option value='TAX_PAYMENTS_GOVERNMENT_AGENCIES'>Tax Payments - Government Agencies</option>
            <option value='TAXICABS_AND_LIMOUSINES'>Taxicabs and limousines</option>
            <option value='TELECOMMUNICATION_SERVICES'>Telecommunication Services</option>
            <option value='TELEPHONE_CARDS'>Telephone Cards</option>
            <option value='TELEPHONE_EQUIPMENT'>Telephone Equipment</option>
            <option value='TELEPHONE_SERVICES'>Telephone Services</option>
            <option value='THEATER'>Theater</option>
            <option value='TIRE_RETREADING_AND_REPAIR'>Tire Retreading and Repair</option>
            <option value='TOLL_OR_BRvalueGE_FEES'>Toll or Brvaluege Fees</option>
            <option value='TOOLS_AND_EQUIPMENT'>Tools and equipment</option>
            <option value='TOURIST_ATTRACTIONS_AND_EXHIBITS'>Tourist Attractions And Exhibits</option>
            <option value='TOWING_SERVICE'>Towing service</option>
            <option value='TOYS_AND_GAMES'>Toys and games</option>
            <option value='TRADE_AND_VOCATIONAL_SCHOOLS'>Trade And Vocational Schools</option>
            <option value='TRADEMARK_INFRINGEMENT'>Trademark Infringement</option>
            <option value='TRAILER_PARKS_AND_CAMPGROUNDS'>Trailer Parks And Campgrounds</option>
            <option value='TRAINING_SERVICES'>Training services</option>
            <option value='TRANSPORTATION_SERVICES'>Transportation Services</option>
            <option value='TRAVEL'>Travel</option>
            <option value='TRUCK_AND_UTILITY_TRAILER_RENTALS'>Truck And Utility Trailer Rentals</option>
            <option value='TRUCK_STOP'>Truck Stop</option>
            <option value='TYPESETTING_PLATE_MAKING_AND_RELATED_SERVICES'>Typesetting, Plate Making, and Related Services</option>
            <option value='USED_MERCHANDISE_AND_SECONDHAND_STORES'>Used Merchandise And Secondhand Stores</option>
            <option value='USED_PARTS_MOTOR_VEHICLE'>Used parts - motor vehicle</option>
            <option value='UTILITIES'>Utilities</option>
            <option value='UTILITIES_ELECTRIC_GAS_WATER_SANITARY'>Utilities - Electric,Gas,Water,Sanitary</option>
            <option value='VARIETY_STORES'>Variety Stores</option>
            <option value='VEHICLE_SALES'>Vehicle sales</option>
            <option value='VEHICLE_SERVICE_AND_ACCESSORIES'>Vehicle service and accessories</option>
            <option value='VvalueEO_EQUIPMENT'>Vvalueeo Equipment</option>
            <option value='VvalueEO_GAME_ARCADES_ESTABLISH'>Vvalueeo Game Arcades/Establish</option>
            <option value='VvalueEO_GAMES_AND_SYSTEMS'>Vvalueeo Games &#38;Systems</option>
            <option value='VvalueEO_TAPE_RENTAL_STORES'>Vvalueeo Tape Rental Stores</option>
            <option value='VINTAGE_AND_COLLECTIBLE_VEHICLES'>Vintage and Collectible Vehicles</option>
            <option value='VINTAGE_AND_COLLECTIBLES'>Vintage and collectibles</option>
            <option value='VITAMINS_AND_SUPPLEMENTS'>Vitamins &#38;Supplements</option>
            <option value='VOCATIONAL_AND_TRADE_SCHOOLS'>Vocational and trade schools</option>
            <option value='WATCH_CLOCK_AND_JEWELRY_REPAIR'>Watch, clock, and jewelry repair</option>
            <option value='WEB_HOSTING_AND_DESIGN'>Web hosting and design</option>
            <option value='WELDING_REPAIR'>Welding Repair</option>
            <option value='WHOLESALE_CLUBS'>Wholesale Clubs</option>
            <option value='WHOLESALE_FLORIST_SUPPLIERS'>Wholesale Florist Suppliers</option>
            <option value='WHOLESALE_PRESCRIPTION_DRUGS'>Wholesale Prescription Drugs</option>
            <option value='WILDLIFE_PRODUCTS'>Wildlife Products</option>
            <option value='WIRE_TRANSFER'>Wire Transfer</option>
            <option value='WIRE_TRANSFER_AND_MONEY_ORDER'>Wire transfer and money order</option>
            <option value='WOMEN_ACCESSORY_SPECIALITY'>Women's Accessory/Speciality</option>
            </select>
            <textarea class='optional' disabled required maxlength='127' name='proddesc' rows='10' cols='40' placeHolder='Describe the products in your box in one sentence (127 max characters)'></textarea>
            </fieldset>
            <fieldset id='curation2'><legend class='primary-color'>Shipping address</legend>
            <label>We will use this info to calculate the cost of shipping to your fans and to generate the postage / shipping labels you will need to ship your boxes.</label>
            <input name='address_line_1' type='text' class='optional' disabled required value='' placeHolder='Street address'/>
            <input name='address_line_2' type='text' class='optional' disabled value='' placeHolder='Address line 2 (optional)'/>
            <input name='admin_area_2' type='text' class='optional' disabled required value='' placeHolder='City'/>
            <input name='admin_area_1' type='text' class='optional' disabled required value='' placeHolder='State'/>
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
<option value='VC' label='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option>
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
<option value='YD' label='People's Democratic Republic of Yemen'>People's Democratic Republic of Yemen</option>
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
            <option value='SU' label='Union of Soviet Socialist Republics'>Union of Soviet Socialist Republics</option>
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
            <option value='HM' label='Heard Island and McDonald Islands'>Heard Island and McDonald Islands</option>
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
            <option value='GS' label='South Georgia and the South Sandwich Islands'>South Georgia and the South Sandwich Islands</option>
            <option value='TK' label='Tokelau'>Tokelau</option>
            <option value='TO' label='Tonga'>Tonga</option>
            <option value='TV' label='Tuvalu'>Tuvalu</option>
            <option value='UM' label='U.S. Minor Outlying Islands'>U.S. Minor Outlying Islands</option>
            <option value='VU' label='Vanuatu'>Vanuatu</option>
            <option value='WF' label='Wallis and Futuna'>Wallis and Futuna</option>
        </optgroup>
    </select>
            <input name='postal_code' type='text' class='optional' disabled required value='' placeHolder='Postal code'/>

            </fieldset>
    
         <input type='submit' value='Save'/>
         
        </form>
        </div>";
}else{

    echo "<div  id='module'><div class='alert'><p class='material-icons'>info</p><p>You've already created a <a class='one-em-font' href='/box/index'>box</a>.<p></p></div></div>";
}
        ?>

@endsection
