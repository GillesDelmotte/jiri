import JiriList from './components/JiriList';
import CreateJiri from './components/create/CreateJiri';
import Dashboard from './components/Dashboard';
import BasicInfos from './components/create/BasicInfos';
import AddJudges from "./components/create/AddJudges";


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
                path: '',
                name:'basicInfos',
                component: BasicInfos

            },
            {
                path:'/addJudges',
                name: 'addJudges',
                component: AddJudges
            }
        ]
    },{
        path: '/dashboard',
        name:'Dashboard',
        component: Dashboard
    },
]
