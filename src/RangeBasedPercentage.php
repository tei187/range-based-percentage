<?php
    namespace tei187;

    /**
     * Class designed to find percentage of a value based on start and end points (with these points being lower and upper limits).
     * @author Piotr Bonk <bonk.piotr@gmail.com>
     * @license MIT
     */
    Class RangeBasedPercentage {
        /** @var integer|float Start point / lower limit. */
        private $start = 0;
        /** @var integer|float End point / upper limit. */
        private $end   = 100;
        /** @var integer|float Difference between start and end points. */
        private $span  = 100;
        /** @var integer Rounding precision. */
        private $round = 5;

        /**
         * Class constructor.
         *
         * @param integer|float $start     Start point / lower limit. '0' by default.
         * @param integer|float $end       End point / upper limit. '100' by default.
         * @param integer       $precision Rounding precision. '5' by default.
         */
        function __construct($start = 0, $end = 100, Int $precision = 5) {
            $this->setRange($start, $end);
            $this->setRound($precision);
        }

        /**
         * Set min and max range.
         *
         * @param integer|float $x Range start.
         * @param integer|float $y Range end.
         * @return RangeBasedPercentage
         */
        public function setRange($x, $y) : RangeBasedPercentage {
            $this->checkValues($x, $y);
            $this->calculateSpan();
            return $this;
        }

        /**
         * Calculates and assigns span/difference betweeen start and end points (used for proportionate calc further on).
         *
         * @return void
         */
        private function calculateSpan() : void {
            $this->span = $this->end - $this->start;
            return;
        }

        /**
         * Rounds to given decimal point.
         *
         * @param integer $precision Rounding precision. '5' by default.
         * @return RangeBasedPercentage
         */
        public function setRound(Int $precision = 5) : RangeBasedPercentage {
            $this->round = $precision;
            return $this;
        }

        /**
         * Returns percentage, based on input value and start/end points.
         *
         * @param integer|float $x Value between start/end points to ascertain.
         * @return integer|float Percentage
         */
        public function getPercentage($x) {
            if ($x >= $this->end) {
                $x = $this->end;
            } elseif ($x <= $this->start) {
                $x = $this->start;
            }

            //$v = $x - $this->span;
            $v = $x - $this->start;
            $o = ($v * 100) / $this->span;

        // debug start
        
            /*echo "<pre>";
            print_r([
                "start" => $this->start, 
                "end" => $this->end, 
                "span" => $this->span,
                "get" => $x, 
                "relative" => $v, 
                "output" => $o
            ]);
            echo "</pre>";*/
        
        // debug end

            return round($o, $this->round);
        }

        /**
         * Verifies if set values are correct. Forces left-lower value assignment.
         *
         * @param integer|float $x Range start.
         * @param integer|float $y Range end.
         * @return boolean
         */
        private function checkValues($x, $y) : bool {
            $this->start = is_numeric($x) ? $x : 0;
            $this->end = is_numeric($y) ? $y : 100;

            // check if start > end
            $check = $this->start > $this->end ? [ $this->end, $this->start ] : null;
            if(is_array($check)) {
                $this->start = $check[0];
                $this->end = $check[1];
            }

            if(!is_numeric($x) OR !is_numeric($y)) {
                return false;
            }
            return true;
        }
    }
?>