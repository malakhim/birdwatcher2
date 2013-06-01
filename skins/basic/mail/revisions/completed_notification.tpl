{$user.firstname} {$user.lastname}<br /><br />
{$lang.revisions_history}: <a href="{$history_link|replace:'&amp;':'&'}">{$history_link|replace:'&amp;':'&'}</a><br /><br />
{$lang.date}: {$time|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}