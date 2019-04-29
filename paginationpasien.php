<?php
include_once("include/config.php");

$statementt = $db_con->prepare("select * from pasien where pasien_id > :pasien_id");
$statementt->execute(array(':pasien_id' => 0));
//$statement::rowCount();

$list = $statementt->fetchAll(PDO::FETCH_ASSOC);

$limit = 50;

$total_records = count($list);
$total_pages = ceil($total_records / $limit);

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

$statement = $db_con->prepare("select * from pasien ORDER BY pasien_id ASC LIMIT $start_from, $limit");
$statement->execute();
$list['rec'] = $statement->fetchAll(PDO::FETCH_ASSOC);
$list['paginationpasien'] = paginate_function($limit, $page, $total_records, $total_pages);
echo json_encode($list);

function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $paginationpasien = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
        $paginationpasien .= '<ul class="paginationpasien">';

        $right_links = $current_page + 3;
        $previous = $current_page - 3; //previous link
        $next = $current_page + 1; //next link
        $first_link = true; //boolean var to decide our first link

        if ($current_page > 1) {
            $previous_link = ($previous == 0) ? 1 : $previous;
            $paginationpasien .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $paginationpasien .= '<li><a href="#" data-page="' . $previous_link . '" title="Previous">&lt;</a></li>'; //previous link
            for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
                if ($i > 0) {
                    $paginationpasien .= '<li><a href="#" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
                }
            }
            $first_link = false; //set first link to false
        }

        if ($first_link) { //if current active page is first link
            $paginationpasien .= '<li class="first active"><span class="custom-active">' . $current_page . '</span></li>';
        } elseif ($current_page == $total_pages) { //if it's the last active link
            $paginationpasien .= '<li class="last active"><span class="custom-active">' . $current_page . '</span></li>';
        } else { //regular current link
            $paginationpasien .= '<li class="active"><span class="custom-active">' . $current_page . '</span></li>';
        }

        for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
            if ($i <= $total_pages) {
                $paginationpasien .= '<li><a href="#" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($current_page < $total_pages) {
            $next_link = ($i > $total_pages) ? $total_pages : $i;
            $paginationpasien .= '<li><a href="#" data-page="' . $next_link . '" title="Next">&gt;</a></li>'; //next link
            $paginationpasien .= '<li class="last"><a href="#" data-page="' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
        }

        $paginationpasien .= '</ul>';
    }
    return $paginationpasien; //return paginationpasien links
}

exit;
?>

                
                
             
                
               
             