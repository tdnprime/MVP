<div class="stars-grid">
    @php
        
        if (isset($avg_reviews)) {
            if ($avg_reviews == 5) {
                $stars = 5;
                $diff = 0;
            }
            if ($avg_reviews < 5 && $avg_reviews != 0) {
                $stars = $avg_reviews;
                $diff = 5 - $stars;
            }
            if ($avg_reviews == 0) {
                $stars = 0;
                $diff = 5;
            }
        } else {
            $stars = 0;
            $diff = 5;
        }
        
    @endphp

    @for ($s = 0; $s < $stars; $s++)
        <span class="material-icons text-black">star</span>
    @endfor

    @for ($d = 0; $d < $diff; $d++)
        <span class="material-icons text-grey">star</span>
    @endfor
    <span>{{ $total_reviews }} Reviews</span>
</div>
