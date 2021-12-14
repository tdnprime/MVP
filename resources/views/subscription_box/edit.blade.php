@extends('layouts.create-box')

@section('content')


<div>
    <form name='basics' action='{{ route('box.update',$user->id) }}' method='post'>
        @csrf
        @method('PUT')
        <fieldset>

        <input type='number'  required value='{{$box->price}}' name='price' min='$price' max='$price'>
        <input type='text'  required value='{{$box->page_name}}' placeholder='Youtube channel name' name='page_name'>
        <input type='number'  required value='{{$box->box_supply}}' placeholder='Number of subscriptions you will initially accept' name='box_supply' min='1' max='1000000'>
        </fieldset>
        <fieldset>
        <label>Do you need help with product curation?</label>
        <label>Yes
        <input type='radio' id='disable' value='1' checked name='curation'/>
        </label><label>
        No
         <input type='radio' id='removeDisabled' value='0' name='curation'/>
        </label>
        </fieldset>
       <fieldset>
        <input class='optional' type='number' disabled required name='num_products' placeholder='Number of products in box' min='1' max='25'>
        <input class='optional' type='number' disabled required value='' placeholder='Weight of box in pounds' name='box-weight' min='1' max='1000000'>
        <input class='optional' type='number'  disabled required value='' placeholder='Length of box in inches' name='box-length' min='1' max='1000000'>
        <input class='optional' type='number'  disabled required value='' placeholder='Width of box in inches' name='box-width' min='1' max='1000000'>
        <input class='optional' type='number' disabled required value='' placeholder='Height of box in inches' name='box-height' min='1' max='1000000'>
        </fieldset>
        <input type='hidden' value='basics'></input>
        </fieldset>

        <fieldset>
            <select required name='prodname'>
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
            <textarea required maxlength='127' name='proddesc' rows='10' cols='40' placeHolder='Sell your box in one sentence (127 max characters)'></textarea>

        <fieldset>
         <input type='submit' value='Save'/>
         </fieldset>



        </form>
    </div>


@endsection
