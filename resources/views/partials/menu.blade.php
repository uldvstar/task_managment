<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li>
                    <a href="{{route('project.dashboard')}}">
                        <i class="iconsminds-project"></i> Jobs
                    </a>
                </li>
                <li>
                    <a href="{{route('task.dashboard')}}">
                        <i class="iconsminds-check"></i> Tasks
                    </a>
                </li>
                <li>
                    <a href="{{route('client.dashboard')}}">
                        <i class="iconsminds-affiliate"></i> Customers
                    </a>
                </li>
                <li>
                    <a href="#applications">
                        <i class="iconsminds-library"></i> Docs
                    </a>
                </li>
                <li>
                    <a href="#setup">
                        <i class="iconsminds-gears"></i> Setup
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="setup">
                <li>
                    <a href="{{route('client.types')}}">
                        <i class="simple-icon-umbrella"></i> <span class="d-inline-block">Customer Groups</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('department.dashboard')}}">
                        <i class="simple-icon-vector"></i> <span class="d-inline-block">Company Departments</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('project.types')}}">
                        <i class="simple-icon-organization"></i> <span class="d-inline-block">Business Services</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('modular_type.dashboard', 'task')}}">
                        <i class="simple-icon-layers"></i> <span class="d-inline-block">Task Types</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('modular_type.dashboard', 'document')}}">
                        <i class="simple-icon-paper-clip"></i> <span class="d-inline-block">Attachment Types</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>