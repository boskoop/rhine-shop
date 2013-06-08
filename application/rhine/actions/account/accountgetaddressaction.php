<?php namespace Rhine\Actions\Account;

use Rhine\Repositories\AddressRepository;
use Laravel\View;
use User;

class AccountGetAddressAction
{

	private $addressRepository;

	function __construct(AddressRepository $addressRepository)
	{
		$this->addressRepository = $addressRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		$address = $this->addressRepository->findByUserId($user->id);

		return View::make('account.address')
		->with(compact('user'))
		->with(compact('address'));
	}

}