<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\Menu\ListMenuRepository;

use Tests\Unit\MenuListTestable;

class MenuListTest extends TestCase
{
    use MenuListTestable;

    /**
     * Test Menu List Generated Correctly.
     *
     * @return void
     */
    public function test_menu_list_generated_correctly(): void
    {   
        $resultArrayProvided = self::_resultArrayProvided();
        
        $listMenuRepository = ListMenuRepository::list(
            self::_providedArgumentArray()
        );
        
        $this->assertEquals(
            count($listMenuRepository), count($resultArrayProvided)
        );
        
        $this->assertTrue(            
            $listMenuRepository != $resultArrayProvided ? false : true
        );
    }
    
}
