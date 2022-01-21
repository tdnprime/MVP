<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
/* AN IDEA...
1. Collect the list of URLs to RSS feeds into an array.
2. Download the content from that RSS's.
3. Prepare the date for output (merge and sort the data).
4. Display the mix of news stories.

No cache. No database. No even flat-files. Everything simple and dynamically generating on the fly.
(Although in real world project the data should be cached and stored in DB. And have nice front-end/user interface too.)
 */

    public function shorten_text($text, $limit)
    {
        if (($text = str_replace('&nbsp;', ' ', $text)) &&
            (strlen($text) > $limit)) {

            // cut overflow.
            $text = substr($text, 0, $limit);

            // trying to find the first space, to not cut the whole words.
            if ($i = strrpos($text, ' ')) {
                $text = substr($text, 0, $i);
            }

            // if the last character is dot (.) we don't need to append 3 dots.
            $text .= substr($text, -1) == '.' ? '..' : '&hellip;'; // "&hellip;" it's "...". But if the last character is dot, let's add only 2 dots.
        }

        return $text;
    }

    public function fetch_rss(&$feed, $url, $source_name)
    {
        if (!$xml = @simplexml_load_file($url)) {
            return false;
        }
        // can't get data from URL, or it's not XML. (@ -- don't display PHP errors.)

        foreach ($xml->channel->xpath('//item') as $xml_item) { // fetch all <item> tags from the XML
            $feed_item = false;
            $feed_item['title'] = strip_tags(trim($xml_item->title));
            $feed_item['description'] = strip_tags(trim($xml_item->description));
            $feed_item['link'] = strip_tags(trim($xml_item->link));
            $feed_item['date'] = strtotime($xml_item->pubDate);
            $feed_item['source'] = $source_name;
            $feed[] = $feed_item;
        }
        return $feed;
    }

    public function feed()
    {
        if($user = Auth::user()){
            $id = auth()->user()->id;
            $user = User::find($id);
        }

// 1. Collecting the list of URLs to RSS feeds into an array.
        $rss_urls = array(
            'CNN' => 'http://rss.cnn.com/rss/edition.rss',
            'BBC' => 'http://feeds.bbci.co.uk/news/world/us_and_canada/rss.xml',
            'NPR' => 'https://www.npr.org/rss/rss.php?id=1001',
        );

// 2. Downloading the content from that RSS's.
        if (!is_array($rss_urls)) {
            die('The URLs to RSS feed(s) is not provided');
        }

        $feed = false; // initialize an array to use it as container of data which we'll retrieve from RSS feeds.
        foreach ($rss_urls as $name => $url) {
            self::fetch_rss($feed, $url, $name);
        }

        if (!$feed) {
            die('No data to display. (Unable to retrieve XML dat from provided URLs.)');
        }

// 3. Preparing the date for output (merge and sort the data).
        usort($feed, function ($a, $b) { // sorting an array by the date of sub-array
            return $b['date'] - $a['date']; // comparing dates of 2 items
        });

// 4. Displaying the mix of news stories.
        $data= array();
        foreach ($feed as $feed_item => $item) {
            $MAX_TITLE_LENGTH = 40;
            $MAX_TEXT_LENGTH = 40;
            // I used standard US date format and 12-hours time format, but you may set custom format, depending on location of visitor. See manual on PHP date() function.
            // You you prefer European and 24-hours format -- use 'd.m.Y G:i:s'.
            $time = date('m/d/Y g:i:s A', $item['date']);
            $title = self::shorten_text($item['title'], $MAX_TITLE_LENGTH);
            $text = self::shorten_text($item['description'], $MAX_TEXT_LENGTH);

           array_push($data, array(
                'time' => $time,
                'title' => $title,
                'text' => $text,
                'source' => $item['source'],
                'link' => $item['link']
            ));

        }
        return view('blog.index', compact('user', $user))
        ->with('feed', $data);
    }
}
