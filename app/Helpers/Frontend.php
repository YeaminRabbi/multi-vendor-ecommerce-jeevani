<?php
namespace App\Helpers;

use App\Models\SiteSettings;
use App\Models\Cart;
use App\Models\WidgetGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;

class Frontend {
    public static function authCheckoutProcess()
    {
        return true;
    }

    public static function filePath($filename){
        return Storage::url($filename);
    }

    public static function footerSettings($group, $key){
        return SiteSettings::where('group', $group)->where('name', $key)->first()->payload ?? null;
    }

    public static function countCartItems()
    {
        // Handle session for guests or user_id for logged-in users
        $sessionId = session()->getId();
        $userId = Auth::check() ? Auth::id() : null;

        // Count the items in the cart, considering both session_id for guests and user_id for logged-in users
        $cartItems = Cart::where(function ($query) use ($sessionId, $userId) {
            if ($userId) {
                $query->where('user_id', $userId)->orwhere('session_id', $sessionId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->count();

        return $cartItems;
    }

    public static function getWidgetByGroupName($name, $widgetName = null){

        // Retrieve the widget group with its associated widgets
        $widgetGroup = WidgetGroup::with('widgets')->where('group_name', $name)->first();

        if(!$widgetGroup) {
            return null; // Return null if no group is found
        }

        // If a specific widget name is provided, return the matching widget
        if($widgetName){
            return $widgetGroup->widgets->firstWhere('meta_name', $widgetName);
        }

        // If no specific widget name is provided, return all widgets in the group
        return $widgetGroup;
    }

    public static function convertMarkdownToHtml(string $markdown): string
    {
        $converter = new CommonMarkConverter();
//        $content = $converter->convertToHtml($markdown);
        $c = self::parseShortcodes($markdown);
        return $converter->convertToHtml($c);
    }

    public static function parseShortcodes($content)
    {
        // Define your shortcodes and their replacements
        $shortcodes = [
            '/\[button class="([^"]+)" link="([^"]+)" label="([^"]+)"\]/' => '<a class="$1" href="$2">$3</a>', // Shortcode for a button
            '/\[hello\]/' => '<a href="#">Hello</a>', // Shortcode for a link
            // Add more shortcodes as needed
        ];

        // Replace the shortcodes in the content
        foreach ($shortcodes as $pattern => $replacement) {
            $content = preg_replace($pattern, $replacement, $content);
        }

        return $content;
    }
}
