<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-tasks">
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 1</strong>
                        <span class="pull-right text-muted">40% Complete</span>
                    </p>

                    <div>
                        @include('widgets.progress', array('animated'=> true, 'class'=>'success', 'value'=>'40'))
                        <span class="sr-only">40% Complete (success)</span>
                    </div>

                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 2</strong>
                        <span class="pull-right text-muted">20% Complete</span>
                    </p>

                    <div>
                        @include('widgets.progress', array('animated'=> true, 'class'=>'info', 'value'=>'20'))
                        <span class="sr-only">20% Complete</span>
                    </div>

                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 3</strong>
                        <span class="pull-right text-muted">60% Complete</span>
                    </p>

                    <div>
                        @include('widgets.progress', array('animated'=> true, 'class'=>'warning', 'value'=>'60'))
                        <span class="sr-only">60% Complete (warning)</span>
                    </div>

                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#">
                <div>
                    <p>
                        <strong>Task 4</strong>
                        <span class="pull-right text-muted">80% Complete</span>
                    </p>

                    <div>
                        @include('widgets.progress', array('animated'=> true,'class'=>'danger', 'value'=>'80'))
                        <span class="sr-only">80% Complete (danger)</span>
                    </div>

                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a class="text-center" href="#">
                <strong>See All Tasks</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-tasks -->
</li>