<input name='{{ $billing ?? '' }}given_name' type='text' required value='{{ $address->given_name ?? '' }}'
    placeHolder='First name' />
<input name='{{ $billing ?? '' }}family_name' type='text' required value='{{ $address->family_name ?? '' }}'
    placeHolder='Family name' />
<input name='{{ $billing ?? '' }}address_line_1' type='text' required value='{{ $address->address_line_1 ?? '' }}'
    placeHolder='Street address' />
<input name='{{ $billing ?? '' }}address_line_2' type='text' value='{{ $address->address_line_2 ?? '' }}'
    placeHolder='Address line 2 (optional)' />
<input name='{{ $billing ?? '' }}admin_area_2' type='text' required value='{{ $address->admin_area_2 ?? '' }}'
    placeHolder='City' />
<input name='{{ $billing ?? '' }}admin_area_1' type='text' required value='{{ $address->admin_area_1 ?? '' }}'
    placeHolder='State' />
<select required name='{{ $billing ?? '' }}country_code' class='form-control' id='country'>
    <option value='{{ $address->country_code ?? '' }}'>{{ $address->country_code ?? 'Select your country' }}
    </option>
    <optgroup id='country-optgroup-Americas' label='Americas'>
        <option value='US' label='United States'>United States</option>
        <option value='BR' label='Brazil'>Brazil</option>
        <option value='CA' label='Canada'>Canada</option>
    </optgroup>
</select>
<input name='{{ $billing ?? '' }}postal_code' type='text' required value='{{ $address->postal_code ?? '' }}'
    placeHolder='Postal code' />
