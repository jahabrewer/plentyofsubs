<?php
class ApplicationsController extends AppController {

	public function isAuthorized($user) {
		if (parent::isAuthorized($user)) {
			return true;
		}

		// teachers (and admins) only
		if ($user['role'] === 'teacher') {
			// check for ownership of absence
			$application_id = $this->request->params['pass'][0];
			$this->Application->id = $application_id;
			$absence_id = $this->Application->field('absence_id');
			return $this->Application->Absence->isOwnedBy($absence_id, $user['id']);
		}

		$this->Session->setFlash('You are not authorized for that action');
		return false;
	}

	public function accept($id = null) {
		// auth module ensures ownership, so no need to check here
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid application'));
		}

		// give the sub the absence
		$applicant_id = $this->Application->field('user_id');
		$absence_id = $this->Application->field('absence_id');
		$this->Application->Absence->read(null, $absence_id);
		$this->Application->Absence->set('fulfiller_id', $applicant_id);
		$this->Application->Absence->save();

		// clear the other applications
		if ($this->Application->deleteAll(array('Application.absence_id' => $absence_id))) {
			$this->Session->setFlash('Application accepted');
		} else {
			$this->Session->setFlash('The application could not be accepted');
		}

		$this->redirect($this->referer());
	}

	public function reject($id = null) {
		// auth module ensures ownership, so no need to check here
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid application'));
		}

		if ($this->Application->delete($id)) {
			$this->Session->setFlash('Application rejected');
		} else {
			$this->Session->setFlash('The application could not be rejected');
		}

		$this->redirect($this->referer());
	}
}
