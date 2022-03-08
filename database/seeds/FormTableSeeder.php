<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forms')->insert([
            'content' => '<div id="i14e" draggable="true" class="row"><div id="i6v7" draggable="true" class="cell">
            </div><div id="iial" draggable="true" class="cell"><form method="get" id="ilx6" draggable="true" class="form"><div id="i3ud" draggable="true" class="form-group"><label id="iudl" draggable="true" class="label">Name</label><input type="text" id="i50j-3" draggable="true" placeholder="Type here your name" required="true" autocomplete="off" min="3" max="10" maxlength="5" class="input"/></div><div id="i3ud-2" draggable="true" class="form-group"><label id="iudl-2" draggable="true" class="label">Amount</label><input type="number" id="i50j-3-2" draggable="true" placeholder="Type Mobile Number" required="true" autocomplete="off" max="10" class="input"/></div><div id="iy9dg" draggable="true" class="form-group"><label id="iviwt" draggable="true" class="label">Email</label><input type="email" id="i9592" draggable="true" placeholder="Type here your email" required="true" autocomplete="off" class="input"/></div><div id="imxr9" draggable="true" class="form-group"><label id="ic3jq" draggable="true" class="label">Gender</label><input type="checkbox" id="ivt7t" draggable="true" value="M" name="Male" autocomplete="off" class="checkbox"/><label id="ifvl6" draggable="true" for="Male" class="checkbox-label">M</label><input type="checkbox" id="iw6te" draggable="true" value="F" name="Female" autocomplete="off" class="checkbox"/><label id="i8l4k" draggable="true" for="Female" class="checkbox-label">F</label></div><div id="i9xn4" draggable="true" class="form-group"><label id="inzvi" draggable="true" class="label">Message</label><textarea id="iauz3" draggable="true" required="true" autocomplete="off" min="3" max="10" maxlength="5" class="textarea"></textarea></div><div id="i5icz" draggable="true" class="form-group"><button type="submit" id="i7ywl" draggable="true" autocomplete="off" class="button">Send</button></div></form></div><div id="i2vh" draggable="true" class="cell">
            </div></div>',
            'style' => '* { box-sizing: border-box; } body {margin: 0;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}.row{display:flex;justify-content:flex-start;align-items:stretch;flex-wrap:nowrap;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;}.cell{min-height:75px;flex-grow:1;flex-basis:100%;}.label{color:rgb(203, 41, 41);}.button{color:rgb(80, 209, 113);text-align:left;float:left;}.textarea{float:right;}.input{float:right;}.checkbox{float:right;}.checkbox-label{float:right;}@media (max-width: 768px){.row{flex-wrap:wrap;}}',

        ]);
    }
}
