<?php

namespace App\Classes;

use App\Models\Announcement;


class AnnouncementUpdate
{
    public function mark_announcements_active_inactive()
    {
        $announcements = Announcement::all();

        if (count($announcements) > 1)
        {
            foreach ($announcements as $elem)
            {
                $start_date = strtotime($elem->start_date);
                $end_date = strtotime($elem->end_date);
                $current_date = strtotime(date("Y-m-d"));
                $for_activation = false;

                if ($current_date >= $start_date)
                {
                    if ($current_date <= $end_date)
                    {
                        // Activate

                        if ($elem->active === 0)
                        {
                            $for_activation = true;
                        }
                    }
                }

                if ($for_activation === true)
                {
                    //Activates the announcement

                    $elem->active = 1;
                    $elem->update();
                }
                else
                {
                    if ($elem->active === 1)
                    {
                        // Deactivates the announcement

                        $elem->active = 0;
                        $elem->update();
                    }
                }
            }
        }
    }
}