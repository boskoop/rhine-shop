<?php namespace Rhine\Actions\Account;

use Laravel\Redirect;
use Rhine\Repositories\AddressRepository;
use Rhine\Services\Validators\Account\AddressValidator;
use Rhine\Services\Validators\ValidationException;
use User;

class AccountPostEditAddressAction
{

	private $addressRepository;
	private $addressValidator;

	public function __construct(AddressRepository $addressRepository, 
			AddressValidator $addressValidator)
	{
		$this->addressRepository = $addressRepository;
		$this->addressValidator = $addressValidator;
	}

	/**
	 * @return Redirect
	 */
	public function execute(User $user, $input)
	{
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		try {
			$this->addressValidator->validate($input);
		} catch(ValidationException $e) {
			return Redirect::to_route('editaddress')
			->with_errors($e->getValidation())
			->with_input();
		}

		$address = $this->addressRepository->findByUserId($user->id);
		$address->gender_id = $input['title'];
		$address->forename = $input['forename'];
		$address->surname = $input['surname'];
		$address->street1 = $input['street1'];
		$address->street2 = $input['street2'];
		$address->zip = $input['zip'];
		$address->city = $input['city'];
		$address->country = $input['country'];
		
		$address->save();

		return Redirect::to_route('address')->with('status', 'save_ok');
	}

}