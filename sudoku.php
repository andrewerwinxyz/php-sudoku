<?php

class Sudoku
{
    protected $sudoku = [
        [3,0,0,0,0,0,9,1,0],
        [0,0,9,0,0,3,0,0,8],
        [0,4,0,0,0,2,0,0,0],
        [0,6,0,0,5,0,0,9,7],
        [0,0,7,2,0,9,3,0,0],
        [9,3,0,0,7,0,0,5,0],
        [0,0,0,5,0,0,0,7,0],
        [6,0,0,8,0,0,4,0,0],
        [0,2,5,0,0,0,0,0,1]
    ];
    
    public function possible($x, $y, $n)
    {
        global $sudoku;

        foreach(range(0, 9) as $i)
        {
            if($sudoku[$y][$i] == $n)
            {
                return false;
            }
        }

        foreach(range(0, 9) as $i)
        {
            if($sudoku[$i][$x] == $n)
            {
                return false;
            }
        }

        $x0 = (floor($x / 3) * 3);
        $y0 = (floor($y / 3) * 3);

        foreach(range(0, 3) as $i)
        {
            foreach(range(0, 3) as $j)
            {
                if($sudoku[$y0 + $i][$x0 + $j] == $n)
                {
                    return false;
                }
            }
        }

        return true;
    }

    public function solve()
    {
        global $sudoku;

        foreach(range(0, 9) as $y)
        {
            foreach(range(0, 9) as $x)
            {
                if($sudoku[$y][$x] == 0)
                {
                    foreach(range(0, 9) as $n)
                    {
                        if($this->possible($y, $x, $n))
                        {
                            $sudoku[$y][$x] = $n;
                            $this->solve();
                            $sudoku[$y][$x] = 0;
                        }

                        return;
                    }
                }
            }
        }

        print_r($sudoku);
    }
}
