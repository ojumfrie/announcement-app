import './App.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.js';
import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';

import Announcements from './pages/announcement/Announcements';
import CreateAnnouncement from './pages/announcement/CreateAnnouncement';
import EditAnnouncement from './pages/announcement/EditAnnouncement';
import Register from './components/frontend/auth/Register';
import Login from './components/frontend/auth/Login';
import NavBar from './layouts/frontend/NavBar';
import Users from './pages/user/Users';
import Unauthorized from './pages/Unauthorized';

function App() {
  return (
    <Router>
      <Routes>
        <Route exact path='/' element={<Announcements />} />
        <Route path='/create-announcement' element={<CreateAnnouncement />} />
        <Route path='/edit-announcement/:id' element={<EditAnnouncement />} />
        
        <Route path='/register' element={<Register />} />
        <Route path='/login' element={<Login />} />

        <Route path='/navbar' element={<NavBar />} />
        <Route path='/users' element={<Users />} />

        <Route path='/unauthorized' element={<Unauthorized />} />
      </Routes>
    </Router>
  );
}

export default App;
