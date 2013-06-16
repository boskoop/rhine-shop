<?php namespace Rhine\Actions\Account;

use Rhine\Repositories\AddressRepository;
use Laravel\View;
use User;
use Address;

class AccountGetEditAddressAction
{

	private $addressRepository;

	function __construct(AddressRepository $addressRepository)
	{
		$this->addressRepository = $addressRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null, $inputAddress = null)
	{
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		$address = $this->addressRepository->findByUserId($user->id);

		if ($inputAddress != null) {
			$address = $inputAddress;
		}

		return View::make('account.editaddress')
		->with(compact('address'))
		->with(compact('user'));
	}

}