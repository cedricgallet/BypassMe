<?php

// ++++++++++++++++++++++++++Convertion date++++++++++++++++++++++++
function convertDate()
{
    return strftime('%d/%m/%Y à %H:%M', strtotime());
}

