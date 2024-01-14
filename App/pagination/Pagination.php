<?php

namespace App\pagination;

use App\model\Model;
use Exception;

class Pagination
{
    use Model;
    public int $cardPerPage = 4;
    public int $paginationRow = 8;
    public string $table = '';

    public function getPageNumber(array $lists, string $table = ''): array
    {
        $table = empty($table) ? $this->table : $table;
        $jobId = $this->getJobIds();

        foreach ($lists as $key => $list) {
            foreach ($jobId as $idx => $value) {
                if($value->id === $list->id) {
                    $list->pageNumber = ceil(($idx + 1) / $this->cardPerPage);
                }
            }
        }

        return $lists;

    }

    public function getJobsPerPage(int $id, string $table = ''): array
    {

        $table = empty($table) ? $this->table : $table;
        $table = $this->table;
        $offset = $id * $this->cardPerPage - $this->cardPerPage;
        $jobs = $this->limit($this->cardPerPage, $offset, $table);

        return $jobs;

    }

    public function getCount(): int
    {
        $sql = "SELECT count(id) as 'count' from $this->table";
        try {

            $stmt = $this->db()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());

        }

        return $result->count;
    }

    public function getMaxRowLenth(): int
    {

        $jobCount = $this->getCount();
        $maxRow = (int) ceil($jobCount / $this->cardPerPage);

        return $maxRow;

    }

    public function getRange(int $pageIdx): array
    {
        $maxDisplay = $this->getMaxRowLenth() - $this->paginationRow;

        $rangeStart = $pageIdx > $maxDisplay + 1 ? $maxDisplay  + 1 : $pageIdx;
        $rangeEnd =  $pageIdx > $maxDisplay ? $maxDisplay : $pageIdx - 1;
        $paginationRange = $this->paginationRow > $pageIdx ? range(1, $this->paginationRow)
                          : range($rangeStart, $this->paginationRow + $rangeEnd);

        return $paginationRange;
    }

    public function getJobIds(): array
    {
        $sql = "SELECT id FROM $this->table ";

        try {
            $stmt = $this->db()->query($sql);
            $result = $stmt->fetchAll();
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $result;
    }

    public function isMax(array $range): bool
    {
        return in_array($this->getMaxRowLenth(), $range);
    }

    public function isMin(array $range): bool
    {
        return in_array(1, $range);
    }
}
