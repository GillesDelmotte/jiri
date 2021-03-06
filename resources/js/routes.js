import JiriList from './components/JiriList';
import CreateJiri from './components/create/CreateJiri';
import Dashboard from './components/Dashboard';
import BasicInfos from './components/create/BasicInfos';
import AddJudges from "./components/create/AddJudges";
import AddStudents from "./components/create/AddStudents";
import AddProjects from "./components/create/AddProjects";
import ModifyJiri from "./components/ModifyJiri";


export default [
    {
        path: '/',
        name:'jiriList',
        component: JiriList
    },
    {
        path: '/createJiri',
        name:'createJiri',
        component: CreateJiri,
        children: [
            {
                path: '/createJiri',
                name:'basicInfos',
                component: BasicInfos

            },
            {
                path:'/addJudges',
                name: 'addJudges',
                component: AddJudges
            },
            {
                path:'/addStudents',
                name: 'addStudents',
                component: AddStudents
            },
            {
                path:'/addProjects',
                name:'addProjects',
                component: AddProjects
            }
        ]
    },
    {
      path: '/modify/:id',
      name:'modifyJiri',
      component:ModifyJiri
    },
    {
        path: '/dashboard',
        name:'Dashboard',
        component: Dashboard
    },
]
