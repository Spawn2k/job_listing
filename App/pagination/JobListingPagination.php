<?php 
namespace App\pagination;




use App\pagination\Pagination;

class JobListingPagination extends Pagination {

    public int $cardPerPage = 6;
    public int $paginationRow = 5;
    public string $table = 'job_listings';
}
